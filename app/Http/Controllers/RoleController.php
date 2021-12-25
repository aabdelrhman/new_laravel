<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertRole;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function __construct(){
        $this->middleware('permission:show-role');
        $this->middleware('permission:create-role' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:edit-role' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:delete-role' , ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::paginate(5);
        return view('Admin.Roles.index' , compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('Admin.Roles.create' , compact('permissions'));
    }

    public function store(insertRole $request)
    {
        try {
            $role = Role::create(['name' => $request->name]);
            $role->attachPermissions($request->permission);
            return redirect()->route('roles.index')->with('success' , __('messages.success add'));
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error' , __('messages.success error'));
        }
    }

    public function show($id)
    {
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $Role_permissions =  $role->permissions ;
        return view('Admin.Roles.edit' , get_defined_vars()) ;
    }
    public function update(insertRole $request, Role $role)
    {
        try {
            $role->name = $request->input('name');
            $role->save();
            $role->syncPermissions($request->input('permission'));
            return redirect()->route('roles.index')->with('success' , __('messages.success update'));
        } catch (\Throwable $th) {
            return redirect()->route('roles.index')->with('error' , __('messages.error update'));
        }

    }
    public function destroy(Role $role)
    {
        $count_role = 0 ;
        $admins = Admin::all();
        foreach($admins as $admin){
            if($admin->hasRole($role->name)){
                $count_role++ ;
            }
        }
        if ($count_role > 0) {
            return redirect()->route('roles.index')->with('error' , __('messages.error delete role'));
        }else{
            $role -> delete();
            return redirect()->route('roles.index')->with('success' , __('messages.success delete role'));
        }
    }
}
