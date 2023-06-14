<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\DiaryEmployee;
use EBuildingDiary\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountingController extends Controller
{
    public function payroll_view(Request $request)
    {
        $view = 'pages.accounting.payroll_view';
        if (view()->exists($view)) {

            $attendance_sum = 0;
            $wage_fund = number_format(0, 2, '.', '');
            $hours_sum = number_format(0, 2, '.', '');

            $employees = Employee::all();

            $filters = (object)[
                'from_date' => date('Y-m-01'),
                'to_date' => date('Y-m-t')
            ];

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $filters->from_date = date("Y-m-d", strtotime($request->from_date));
                $filters->to_date = date("Y-m-d", strtotime($request->to_date));
            }

            $payrolls = [];
            foreach ($employees as $employee) {

                $payroll = (object)[];
                $payroll->employee_id = $employee->id;
                $payroll->employee_name = $employee->name;
                $payroll->position_name = $employee->position->display_name;

                $attendances = DiaryEmployee::leftJoin('diaries', 'diary_employee.diary_id', 'diaries.id')->whereBetween('date', [$filters->from_date, $filters->to_date])->where('diary_employee.employee_id', $employee->id)->get();
                $total_attendances = $attendances->count();

                //Hours
                $total_salary = 0.00;
                $usual_hours = 0.0;
                $weekend_hours = 0.0;
                $holiday_hours = 0.0;
                $night_shift_hours = 0.0;

                $payroll->attendances_data = [];
                foreach ($attendances as $attendance) {

                    if ($attendance->weekend) {
                        $weekend_hours += $attendance->hours;
                    } else if ($attendance->holiday) {
                        $holiday_hours += $attendance->hours;
                    } else if ($attendance->night_shift) {
                        $night_shift_hours += $attendance->hours;
                    } else {
                        $usual_hours += $attendance->hours;
                    }


                    $project_hourly_rate = $this::getAttendanceHourlyRate($employee->id, $attendance->diary->project->id, $attendance->date);

                    $attendance_salary = $project_hourly_rate * $attendance->hours;
                    $total_salary += $attendance_salary;

                    $payroll->attendances_data[] = [
                        'project_id' => $attendance->diary->project->id,
                        'hourly_rate' => floatval($project_hourly_rate),
                        'hours' => $attendance->hours,
                        'attendance_salary' => $attendance_salary,
                        'date' => $attendance->date
                    ];
                }

                $payroll->usual_hours = $usual_hours;
                $payroll->weekend_hours = $weekend_hours;
                $payroll->holiday_hours = $holiday_hours;
                $payroll->night_shift_hours = $night_shift_hours;
                $payroll->total_attendances = $total_attendances;
                $payroll->total_hours = $usual_hours + $weekend_hours + $holiday_hours + $night_shift_hours;
                $payroll->total_salary = number_format($total_salary, 2, '.', '');

                $payrolls[] = $payroll;

                //Statistics
                $hours_sum += $payroll->total_hours;
                $wage_fund += $total_salary;
                $attendance_sum += $total_attendances;
            }

            number_format($wage_fund, 2, '.', '');

            return view($view, ['filters' => $filters, 'wage_fund' => $wage_fund, 'hours_sum' => $hours_sum, 'attendance_sum' => $attendance_sum, 'employee_count' => $employees->count(), 'payrolls' => $payrolls]);
        }

        abort(404);
    }

    public function payroll_update(Request $request)
    {
        $this->validate(request(), [
            'project_id' => 'required|integer|exists:projects,id',
            'employee_id' => 'required|integer|exists:employees,id',
            'parameter' => 'required',
            'value' => 'required'
        ]);

        $employee = Employee::find($request->employee_id);
        $employee_project_data = $employee->projects()
            ->select('start_date')
            ->where('project_id', $request->project_id)
            ->where('end_date', '=', NULL)
            ->get()->first();

        if (is_numeric($request->value)) {
            $request->value = number_format($request->value, 2);

        } else if (is_string($request->value)) {
            $request->value = $request->value === 'true' ? true : false;
        }

        $updated = false;
        $attach_new_date = true;

        //Check if new or existing date
        if ($employee_project_data && date("Y-m-d", strtotime($employee_project_data->start_date)) === date('Y-m-d')) {

            $updated = $employee->projects()->where('end_date', '=', NULL)->sync([$request->project_id => [
                $request->parameter => $request->value
            ]], false);
            $attach_new_date = false;
        }

        if ($attach_new_date) {

            //Set end_date to previous salary

            if ($employee_project_data) {
                $employee->projects()->where('end_date', '=', NULL)->sync([$request->project_id => [
                    $request->parameter => $request->value,
                    'end_date' => date('Y-m-d')
                ]], false);
            } else {
                $employee->projects()->attach($request->project_id, [
                    $request->parameter => $request->value,
                    'start_date' => date('Y-m-d')
                ]);
            }

            $updated = $employee_project_data = $employee->projects()->where('project_id', $request->project_id)->get()->first();

        }

        $saved = $employee->save();

        if ($updated && $saved) {
            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json([
            'message' => 'Error occurred'
        ]);

    }

    private function getAttendanceHourlyRate($employee_id, $project_id, $date)
    {
        //Check if hourly rate is defined for employee on attendance project
        $hourly_rate = DB::table('employee_project')->select('hourly_rate')
            ->where(
                [
                    ['employee_id', $employee_id],
                    ['project_id', $project_id]
                ])
            ->where(function ($query) use ($date) {
                $query->where('start_date', '<=', $date)
                    ->whereNull('end_date')
                ->orWhere([
                    ['start_date', '<=', $date],
                    ['end_date', '>=', $date]
                ]);
            })->orderBy('end_date', 'ASC')->value('hourly_rate');

        //If hourly rate is not defined, then set it to 0.00
        if (empty($hourly_rate)) {
            $hourly_rate = floatval(0.00);
        } else {
            $hourly_rate = floatval($hourly_rate);
        }

        return $hourly_rate;
    }
}
