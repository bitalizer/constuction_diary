<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\Employee;
use EBuildingDiary\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $view = 'pages.projects.index';
        if (view()->exists($view)) {
            $projects = Project::withTrashed()->orderBy('deleted_at', 'ASC')->get();

            $canManage = false;
            if (Auth::user()->can('manage-projects')) {
                $canManage = true;
            }

            return view($view, ['projects' => $projects, 'canManage' => $canManage]);
        }

        abort(404);
    }

    public function view($id)
    {
        $view = 'pages.projects.view';
        if (view()->exists($view)) {
            $project = Project::withTrashed()->findOrFail($id);

            return view($view, ['project' => $project]);
        }

        abort(404);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $saved = Project::create([
            'name' => $request->name,
            'location' => $request->location,
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
        $this->validate(request(), ['id' => 'required|exists:projects,id']);

        $project = Project::withTrashed()->find($request->id);

        if ($project->trashed()) {
            $project->restore();
        } else {
            $project->delete();
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }

    public function edit(Request $request)
    {

        $this->validate(request(), [
            'id' => 'required|integer|exists:projects,id',
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $project = Project::withTrashed()->find($request->id);
        $data = $request->password ? $request->all() : $request->except('password');
        $updated = $project->update($data);

        if ($updated) {
            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json($request);
    }

    public function load(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json([
                'message' => 'Missing required parameters'
            ]);
        }

        $project = Project::find($request->id);

        if (!$project) {
            return response()->toJson([
                'message' => 'Record not found',
            ], 404);
        }

        return $project->toJson();
    }
}
