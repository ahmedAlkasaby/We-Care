<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends MainController
{

    public function index()
    {

        $roles=Role::where('name', '!=', 'admin')->get();
        $permissions=Permission::get();
        $groupedPermissions = collect($permissions)->groupBy('description');

        return view('admin.role.index',compact('roles','groupedPermissions'));

    }
    public function store(RoleRequest $request)
    {
        $request->validated();


        $role=Role::create([
            'name' => $request->name,
            'display_name' => $request->name,
            'description' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        session()->flash('success',__('site.createRole'));

        return redirect()->route('roles.index');
    }







    public function update(RoleRequest $request, Role $role)
    {

        $request->validated();



        $role->update([
            'name' => $request->name,
            'display_name' => $request->name,
            'description' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        session()->flash('success',__('site.updateRole'));
        return redirect()->route('roles.index');

    }
    public function destroy(Role $role){
        if($role->users()->count() ==0){
            $role->delete();
            session()->flash('success',__('site.roleDeleted'));
            return back();
        }else{
            session()->flash('error',__('site.rolecantDelete'));
            return back();
        }
    }


}
