<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\Employee;
use EBuildingDiary\Event;
use EBuildingDiary\EventSequence;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index_view()
    {
        $view = 'pages.events.index_view';
        if (view()->exists($view)) {
            $employees = Employee::all();
            return view($view, ['employees' => $employees]);
        }

        abort(404);
    }

    public function load(Request $request)
    {
        $event_sequences = EventSequence::all();

        $events = [];

        foreach($event_sequences as $event_sequence){
            $events[] = [
                'id' => $event_sequence->event_id,
                'title' => $event_sequence->event->title,
                'information' => $event_sequence->event->information,
                'employees' => $event_sequence->event->employees,
                'backgroundColor' => $event_sequence->event->color,
                'start' => $event_sequence->start_datetime,
                'end' => $event_sequence->end_datetime,
            ];
        }

        //$employee->hire_date = date('d.m.Y', strtotime($employee->hire_date));

        return json_encode($events);
    }
}
