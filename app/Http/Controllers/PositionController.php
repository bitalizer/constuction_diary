<?php

namespace EBuildingDiary\Http\Controllers;

use EBuildingDiary\Employee;
use EBuildingDiary\Permission;
use EBuildingDiary\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    public function index()
    {
        $view = 'pages.positions.index';
        if (view()->exists($view)) {
            $positions = Position::all();

            $canManage = false;
            if (Auth::user()->can('manage-positions')) {
                $canManage = true;
            }

            return view($view, ['positions' => $positions, 'canManage' => $canManage]);
        }

        abort(404);
    }

    public function store_view($id = null)
    {
        $view = 'pages.positions.store_view';
        if (view()->exists($view)) {

            $positions = Position::all();
            $permissions = Permission::all();
            $position = null;

            if ($id !== null) {
                $position = Position::findOrFail($id);
            }

            return view($view, ['positions' => $positions, 'permissions' => $permissions, 'position' => $position]);
        }

        abort(404);
    }

    public function view($id)
    {
        $view = 'pages.positions.view';
        if (view()->exists($view)) {
            $position = Position::findOrFail($id);

            return view($view, ['position' => $position]);
        }

        abort(404);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'display_name' => 'required|string|min:3',
            'description' => 'required|string|min:6',
            'permissions' => 'required|array',
        ]);

        $position = null;

        if ($request->has('id') && !empty($request->id)) {

            $this->validate(request(), [
                'id' => 'required|integer|exists:positions,id',
            ]);

            $position = Position::find($request->id);
        } else {
            $this->validate(request(), [
                'name' => 'required|string|unique:positions',
            ]);

            $position = new Position;
            $position->name = strtolower($request->name);
        }

        $position->display_name = $request->display_name;
        $position->description = $request->description;
        $position->save();

        //Detach current permissions
        $position->detachPermissions();

        //Attach select permissions

        if (!empty($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $permission = Permission::where('name', '=', $permission)->first();

                if ($permission) {
                    $position->attachPermission($permission);
                }
            }
        }

        if ($position) {
            return response()->json([
                'message' => 'OK'
            ]);
        }

        return response()->json([
            'message' => 'Error occurred'
        ]);
    }

    public function delete(Request $request)
    {
        $this->validate(request(), ['id' => 'required|exists:positions,id']);

        $pos_emp_count = Employee::where('position_id', $request->id)->count();

        if ($pos_emp_count > 0) {
            return response()->json([
                'message' => 'Sellel ametikohal on vähemalt üks töötaja'
            ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY, Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]);
        }

        $position = Position::find($request->id);

        //Detach currect permissions
        $position->detachPermissions();

        $position->delete();

        return response()->json([
            'message' => 'OK'
        ]);
    }
}
