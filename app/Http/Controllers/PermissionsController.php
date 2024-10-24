<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      if($request->ajax())
      {
        return $this->getPermission()->make(true);
      }
      return view('users.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsRequest $request)
    {
        $permission = Permission::create($request->validated());

        if($permission) {
            // Store success message in the session
            return redirect()->route('users.permissions.index')->with('success', 'New Permission Added Successfully.');
        }

        // Store error message in the session
        return back()->withInput()->with('error', 'Permission Add Error! Please Try again.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('users.permissions.edit')->with(['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionsRequest $request,  Permission $permission)
    {
        if ($permission->update($request->validated())) {
            return redirect()->route('users.permissions.index')->with('success', 'Permission Updated Successfully.');
        }

        return back()->withInput()->with('error', 'Permission Update Error! Please Try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Permission $permission = null)
    {
        if (is_null($permission)) {
            return response()->json(["message" => "Permission not found"], 404);
        }

        if ($request->ajax() && $permission->delete()) {
            return response()->json(["message" => "Permission Deleted Successfully"], 200);
        }

        return response()->json(["message" => "Data Delete Error! Please Try again"], 500);

    }
    private function getPermission(){
        $data = Permission::get();
        return DataTables::of($data)
        ->addColumn('action', function($data){
            $action = "";
            $action.="<a class='btn btn-warning' id='btnEdit' href='".route('users.permissions.edit', $data->id)."'><i class='fas fa-edit'></i></a>";
            $action.=" <button class='btn  btn-outline-danger' id='btnDel' data-id='".$data->id."'><i class='fas fa-trash'></i></button>";
                return $action;
        });
    }


}
