<?php

namespace EBuildingDiary\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use EBuildingDiary\Diary;
use EBuildingDiary\Employee;
use EBuildingDiary\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Checkdomain\Holiday\Util;

class DocumentController extends Controller
{
    public function index()
    {
        $view = 'pages.documents.index';
        if (view()->exists($view)) {
            return view($view);
        }

        abort(404);
    }

    public function diary_add()
    {
        $view = 'pages.documents.diary_add';
        if (view()->exists($view)) {
            $employees = Employee::all();
            $projects = Project::all();
            return view($view, ['employees' => $employees, 'projects' => $projects]);
        }

        abort(404);
    }

    public function diary_store(Request $request)
    {
        $this->validate(request(), [
            'project_id' => 'required|integer|exists:projects,id',
            'mechanisms' => 'nullable|string',
            'equipment' => 'nullable|string',
            'work_description' => 'required|min:6',
            'comments' => 'nullable|string',
            'instructions' => 'nullable|string',
            'acts_and_documents' => 'nullable|string',
            'control' => 'nullable|string',
            'weather_time' => 'required',
            'weather_temperature' => 'required',
            'date' => 'required',
            'workers' => 'required',
        ]);

        $weather_snow = 0;
        $weather_dry = 0;
        $weather_rain = 0;
        $weather_wind = 0;
        $weather_sleet = 0;

        if ($request->has('weather') && is_array($request->weather)) {
            if (in_array("Lumi", $request->weather)) {
                $weather_snow = 1;
            }

            if (in_array("Kuiv", $request->weather)) {
                $weather_dry = 1;
            }

            if (in_array("Vihm", $request->weather)) {
                $weather_rain = 1;
            }

            if (in_array("Tugev tuul", $request->weather)) {
                $weather_wind = 1;
            }

            if (in_array("Lärts", $request->weather)) {
                $weather_sleet = 1;
            }
        }

        $diary = new Diary();
        $diary->submitter_id = Auth::user()->id;
        $diary->project_id = $request->project_id;
        $diary->mechanisms = $request->mechanisms;
        $diary->equipment = $request->equipment;
        $diary->work_description = $request->work_description;
        $diary->comments = $request->comments;
        $diary->instructions = $request->instructions;
        $diary->acts_and_documents = $request->acts_and_documents;
        $diary->control = $request->control;
        $diary->weather_time = date('H:i:s', strtotime($request->weather_time));
        $diary->weather_temperature = $request->weather_temperature;
        $diary->weather_snow = $weather_snow;
        $diary->weather_dry = $weather_dry;
        $diary->weather_rain = $weather_rain;
        $diary->weather_wind = $weather_wind;
        $diary->weather_sleet = $weather_sleet;
        $diary->date = date("Y-m-d", strtotime($request->date));
        $saved = $diary->save();

        if ($saved) {
            $util = new Util();
            $is_holiday = $util->isHoliday('EE', $diary->date) ? 1 : 0;

            $employee_data = [];
            foreach ($request->workers as $worker) {

                $employee_data[] = [
                    'diary_id' => $diary->id,
                    'employee_id' => $worker['id'],
                    'start_time' => date('H:i', strtotime($worker['start_time'])),
                    'end_time' => date('H:i', strtotime($worker['end_time'])),
                    'hours' => $worker['hours'],
                    'note' => $worker['note'],
                    'weekend' => 0,
                    'holiday' => $is_holiday,
                    'night_shift' => 0
                ];
            }

            DB::table('diary_employee')->insert($employee_data);

            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json($request);
    }

    public function diary_edit(Request $request)
    {
        $this->validate(request(), [
            'id' => 'required|integer|exists:diaries,id',
            'project_id' => 'required|integer|exists:projects,id',
            'mechanisms' => 'nullable|string',
            'equipment' => 'nullable|string',
            'work_description' => 'required|min:6',
            'comments' => 'nullable|string',
            'instructions' => 'nullable|string',
            'acts_and_documents' => 'nullable|string',
            'control' => 'nullable|string',
            'weather_time' => 'required',
            'weather_temperature' => 'required',
            'date' => 'required',
            'workers' => 'required',
        ]);

        $weather_snow = 0;
        $weather_dry = 0;
        $weather_rain = 0;
        $weather_wind = 0;
        $weather_sleet = 0;

        if ($request->has('weather') && is_array($request->weather)) {

            if (in_array("Lumi", $request->weather)) {
                $weather_snow = 1;
            }

            if (in_array("Kuiv", $request->weather)) {
                $weather_dry = 1;
            }

            if (in_array("Vihm", $request->weather)) {
                $weather_rain = 1;
            }

            if (in_array("Tugev tuul", $request->weather)) {
                $weather_wind = 1;
            }

            if (in_array("Lärts", $request->weather)) {
                $weather_sleet = 1;
            }
        }

        $diary = Diary::find($request->id);
        $diary->project_id = $request->project_id;
        $diary->mechanisms = $request->mechanisms;
        $diary->equipment = $request->equipment;
        $diary->work_description = $request->work_description;
        $diary->comments = $request->comments;
        $diary->instructions = $request->instructions;
        $diary->acts_and_documents = $request->acts_and_documents;
        $diary->control = $request->control;
        $diary->weather_time = date('H:i:s', strtotime($request->weather_time));
        $diary->weather_temperature = $request->weather_temperature;
        $diary->weather_snow = $weather_snow;
        $diary->weather_dry = $weather_dry;
        $diary->weather_rain = $weather_rain;
        $diary->weather_wind = $weather_wind;
        $diary->weather_sleet = $weather_sleet;
        $diary->date = date("Y-m-d", strtotime($request->date));
        $saved = $diary->save();

        if ($saved) {
            $util = new Util();
            $is_holiday = $util->isHoliday('EE', $diary->date) ? 1 : 0;

            $employee_data = [];
            foreach ($request->workers as $worker) {

                $employee_data[] = [
                    'diary_id' => $diary->id,
                    'employee_id' => $worker['id'],
                    'start_time' => date('H:i', strtotime($worker['start_time'])),
                    'end_time' => date('H:i', strtotime($worker['end_time'])),
                    'hours' => $worker['hours'],
                    'note' => $worker['note'],
                    'weekend' => 0,
                    'holiday' => $is_holiday,
                    'night_shift' => 0
                ];
            }

            DB::table('diary_employee')->where('diary_id', '=', $request->id)->delete();
            DB::table('diary_employee')->insert($employee_data);

            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json($request);
    }

    public function diary_delete(Request $request)
    {
        if (!$request->has('diary_id')) {
            return response()->json([
                'message' => 'Missing required parameters'
            ]);
        }

        $diary = Diary::findOrFail($request->diary_id);
        $diary->employees()->detach();
        $diary->delete();

        return response()->json([
            'message' => 'OK'
        ]);
    }

    public function diary_view($id)
    {
        $view = 'pages.documents.diary_view';
        if (view()->exists($view)) {
            $diary = Diary::findOrFail($id);
            $employees = Employee::all();
            $projects = Project::all();

            if($diary->project->trashed()){
                $projects->push($diary->project);
            }

            return view($view, ['diary' => $diary, 'employees' => $employees, 'projects' => $projects]);
        }

        abort(404);
    }

    public function diary_download($id)
    {
        $diary = Diary::findOrFail($id);

        $diary_company = DB::table('settings')->where('name', 'company')->first()->value;

        $object_acronym = str_acronym($diary->project->name);
        $signature = sig_from_name($diary->submitter->name);

        $diaries = DB::table('diaries')->where('project_id', $diary->project_id)->get();

        $diary_number = 0;

        foreach ($diaries as $key => $value) {

            if ($value->id === $diary->id) {
                $diary_number = $key + 1;
                break;
            }
        }

        $pdf = PDF::loadView('pages.documents.diary_template', ['diary' => $diary, 'diary_number' => $diary_number, 'diary_company' => $diary_company, 'object_acronym' => $object_acronym, 'signature' => $signature]);
        return $pdf->download(sprintf('Ehitustööde Päevik %s %s.pdf', $object_acronym, date('d.m.Y', strtotime($diary->date))));
    }

    public function diary(Request $request)
    {
        $view = 'pages.documents.diary_index';
        if (view()->exists($view)) {

            $canManage = false;
            if (Auth::user()->can('manage-diaries')) {
                $canManage = true;
            }

            $filters = (object)[
                'from_date' => null,
                'to_date' => null
            ];

            if ($request->filled('from_date') && $request->filled('to_date')) {

                $filters->from_date = date("d.m.Y", strtotime($request->from_date));
                $filters->to_date = date("d.m.Y", strtotime($request->to_date));

                $diaries = Diary::whereBetween('date', [date("Y-m-d", strtotime($request->from_date)), date("Y-m-d", strtotime($request->to_date))])->get();
            } else {
                $diaries = Diary::all();
            }

            return view($view, ['diaries' => $diaries, 'canManage' => $canManage, 'filters' => $filters]);
        }

        abort(404);
    }
}
