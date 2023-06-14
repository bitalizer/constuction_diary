<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\DiaryEmployee;
use EBuildingDiary\Employee;
use EBuildingDiary\Project;
use EBuildingDiary\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $view = 'pages.employees.index';
        if (view()->exists($view)) {
            $employees = Employee::withTrashed()->orderBy('deleted_at', 'DESC')->get();
            $positions = Position::all();

            $canManage = false;
            if (Auth::user()->can('manage-employees')) {
                $canManage = true;
            }

            return view($view, ['employees' => $employees, 'positions' => $positions, 'canManage' => $canManage]);
        }

        abort(404);
    }

    public function view($id)
    {
        $view = 'pages.employees.view';
        if (view()->exists($view)) {
            $employee = Employee::findOrFail($id);
            $projects = Project::all();
            $last_working_day = DiaryEmployee::leftJoin('diaries', 'diary_employee.diary_id', 'diaries.id')->where('diary_employee.employee_id', $employee->id)->orderBy('date', 'desc')->first()->date;

            $projects_salary = [];
            foreach ($projects as $project) {

                $employee_project = $project->employees()
                    ->where('employee_id', $employee->id)
                    ->where('end_date', NULL)->first();

                $projects_salary[] = (object)[
                        'id' => $project->id,
                        'name' => $project->name,
                        'location' => $project->location,
                        'hourly_rate' => $employee_project ? $employee_project->pivot->hourly_rate : '0.00',
                        'weekend_payable' => $employee_project ? $employee_project->pivot->weekend_payable ? true : false :  false,
                        'holiday_payable' => $employee_project ? $employee_project->pivot->holiday_payable ? true: false :  false,
                        'night_shift_payable' => $employee_project ? $employee_project->pivot->night_shift_payable ? true : false :  false,
                        'updated_at' => $employee_project ? date('d.m.Y', strtotime($employee_project->pivot->start_date)) : '-',
                ];
            }

            return view($view, compact('employee', 'projects_salary', 'last_working_day'));
        }

        abort(404);
    }

    public function add(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'string|email|unique:employees|nullable',
            'password' => 'string|min:6|nullable',
            'phone_number' => 'string|nullable',
            'position_id' => 'required|exists:positions,id',
            'hire_date' => 'string|nullable'
        ]);

        if ($request->has('password') && strlen($request->password) > 5) {
            $password = bcrypt($request->password);
        } else {
            $password = bcrypt(str_random(8));
        }

        $saved = Employee::create([
            'name' => $request->name,
            'email' => $request->has('email') ? $request->email : null,
            'password' => $password,
            'phone_number' => $request->has('phone_number') ? $request->phone_number : null,
            'position_id' => $request->position_id,
            'hire_date' => $request->has('hire_date') ? date("Y-m-d", strtotime($request->hire_date)) : null,
            'remember_token' => str_random(10),
        ]);

        if ($saved) {
            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json($request);
    }

    public function archive(Request $request)
    {
        $this->validate(request(), ['id' => 'required|exists:employees,id']);

        $employee = Employee::withTrashed()->find($request->id);

        if ($employee->trashed()) {
            $employee->restore();
        } else {
            $employee->delete();
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }

    public function edit(Request $request)
    {

        $this->validate(request(), [
            'id' => 'required',
            'name' => 'required',
            'email' => 'string|email|nullable',
            'password' => 'string|min:6|nullable',
            'phone_number' => 'string|nullable',
            'position_id' => 'required|exists:positions,id',
            'hire_date' => 'string|nullable'
        ]);

        $employee = Employee::find($request->id);

        if ($request->has('password') && !is_null($request->password)) {
            $data = $request->all();
            $data['password'] = bcrypt($request->password);
        } else {
            $data = $request->except('password');
        }

        if ($request->has('hire_date') && !is_null($request->hire_date)) {
            $data['hire_date'] = date("Y-m-d", strtotime($request->hire_date));
        }

        $employee->fill($data);
        $saved = $employee->save();

        if ($saved) {
            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json([
            'message' => 'Unexpected error'
        ]);
    }

    public function load(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json([
                'message' => 'Missing required parameters'
            ]);
        }

        $employee = Employee::find($request->id);

        if (!$employee) {
            return response()->toJson([
                'message' => 'Record not found',
            ], 404);
        }

        $employee->hire_date = date('d.m.Y', strtotime($employee->hire_date));

        return $employee->toJson();
    }
}
