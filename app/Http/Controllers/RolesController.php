<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;


class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->getRoles();
        }
        return view('users.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('users.roles.create', compact('permissions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $permissions = array_map(function($permission) {
            return trim($permission, '{}'); // remove curly braces
        }, $request->permissions);

        $validPermissions = Permission::whereIn('name', $permissions)->pluck('name')->toArray();

        if (count($validPermissions) != count($permissions)) {
            return back()->with('error', 'Some permissions are invalid or do not exist.');
        }

        // $role = Role::create(['name' => strtolower(trim($request->name))]);
        $role = Role::create(['name'=>strtolower(trim($request->validated('name')))]);
        $role->syncPermissions($validPermissions);

        if ($role) {
            return redirect()->route('users.roles.index')->with('success', 'New Role Added Successfully.');
        }

        return back()->withInput()->with('error', 'Role Add Error! Please try again.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request, Role $role)
    {
        if($request->ajax())
        {
            return $this->getRolesPermissions($role);
        }
        return view('users.roles.show')->with(['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('users.roles.edit')->with(['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Role $role, RoleRequest $request)
    {
        $permissions = array_map(function($permission) {
            return trim($permission, '{}'); // remove curly braces
        }, $request->permissions);

        $validPermissions = Permission::whereIn('name', $permissions)->pluck('name')->toArray();

        if (count($validPermissions) != count($permissions)) {
            return back()->with('error', 'Some permissions are invalid or do not exist.');
        }
        $role->syncPermissions($validPermissions);
        $role->update(['name'=>strtolower(trim($request->validated(['name'])))]);
        if($role)
        {
            return redirect()->route('users.roles.index')->with('success', 'Role Added Successfully.');
        }
        return back()->withInput()->with('error', 'Role Update Error! Please try again.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Role $role)
    {
        if($request->ajax() && $role->delete())
        {
            return response(["message" => "Role Deleted Successfully"], 200);
        }
        return response(["message" => "Data Delete Error! Please Try again"], 201);
    }

    private function getRoles()
    {
        $data = Role::withCount(['users', 'permissions'])->get();
        return DataTables::of($data)
                ->addColumn('name', function($row){
                    return ucfirst($row->name);
                })
                ->addColumn('users_count', function($row){
                    return $row->users_count;
                })
                ->addColumn('permissions_count', function($row){
                    return $row->permissions_count;
                })
                ->addColumn('action', function($row){
                    $action = "";
                    $action.="<a class='btn btn-xs btn-success' id='btnShow' href='".route('users.roles.show', $row->id)."'><i class='fas fa-eye'></i></a> ";
                    $action.="<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('users.roles.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
                    $action.=" <button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
                    return $action;
                })
                ->make('true');
    }

    private function getRolesPermissions($role)
    {
        $permissions = $role->permissions;
        return DataTables::of($permissions)->make('true');
    }
}
