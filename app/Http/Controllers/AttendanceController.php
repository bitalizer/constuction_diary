<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\Diary;
use EBuildingDiary\DiaryEmployee;
use EBuildingDiary\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function table_view(Request $request)
    {
        $view = 'pages.attendances.table_view';
        if (view()->exists($view)) {

            $filters = (object)[
                'from_date' => date('Y-m-01'),
                'to_date' => date('Y-m-t'),
                'employee' => null
            ];

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $filters->from_date = date("Y-m-d", strtotime($request->from_date));
                $filters->to_date = date("Y-m-d", strtotime($request->to_date));
            }

            if ($request->id !== null) {

                $employee = Employee::findOrFail($request->id);
                $attendances = DiaryEmployee::leftJoin('diaries', 'diary_employee.diary_id', 'diaries.id')->whereBetween('date', [$filters->from_date, $filters->to_date])->where('diary_employee.employee_id', $request->id)->get();
                $filters->employee = $employee;

            } else {
                $attendances = DiaryEmployee::leftJoin('diaries', 'diary_employee.diary_id', 'diaries.id')->whereBetween('date', [$filters->from_date, $filters->to_date])->get();
            }

            return view($view, ['attendances' => $attendances, 'filters' => $filters]);
        }

        abort(404);
    }

    public function calendar_view(Request $request)
    {
        $view = 'pages.attendances.calendar_view';
        if (view()->exists($view)) {
            return view($view);
        }

        abort(404);
    }

    public function calendar_load(Request $request)
    {

        $diaries = Diary::all();

        $events = [];
        foreach ($diaries as $diary) {

            foreach ($diary->employees as $attendance) {

                $events[] = [
                    'title' => $attendance->name . ' (' . $attendance->pivot->hours . 'h)',
                    'start' => $diary->date,
                ];
            }
        }

        return json_encode($events);
    }
}
