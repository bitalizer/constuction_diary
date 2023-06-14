<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\Employee;
use EBuildingDiary\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function general_view()
    {
        $view = 'pages.settings.general_view';
        if (view()->exists($view)) {

            $variables = DB::table('settings')->get()->pluck('value', 'name');

            return view($view, ['variables' => $variables]);
        }


        abort(404);
    }

    public function store(Request $request)
    {
        if (!$request->has('variables') && !is_array($request->variables)) {
            return response()->json([
                'message' => 'Missing required parameters'
            ]);
        }

        foreach ($request->variables as $variable) {

            DB::table('settings')
                ->where('name', $variable['name'])
                ->update(['value' => $variable['value']]);
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }
}
