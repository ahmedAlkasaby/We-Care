<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Api\MainController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\City;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminController extends MainController
{


    public function index()
    {
        $authUser=auth()->user()->id;
        $admins = User::where('id','!=',$authUser)
        ->where('is_admin',1)
        ->filter(request('search'))
        ->latest()
        ->paginate(50);
        $excludedRoles = ['volunteer', 'user','doner','case'];
        $roles = Role::whereNotIn('name', $excludedRoles)->get();
        $cities=City::all();
        return view('admin.admin.index',compact('admins','roles','cities'));
    }

    public function store(AdminRequest $request)
    {
        $request->validated();


        $data=[
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'is_admin'=>1,
            "gender"=>$request->gender,
            'lang'=> $request->lang
        ];

        if ($request->region_id) {
            $city_id = $this->getCityByRegion($request->region_id);
            $data['region_id']=$request->region_id;
            $data['city_id']=$city_id;
        }

        $admin=User::create($data);
        $role=Role::find($request->role_id);
        $admin->addRole($role->name);
        return response()->json([
            'status'=>true,
            'message'=>__('site.createAdmin')
        ]);

    }




    public function update(AdminRequest $request)
    {
        $data=[
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'is_admin'=>1,
            "gender"=>$request->gender,
            'lang'=> $request->lang
        ];

        if ($request->region_id) {
            $city_id = $this->getCityByRegion($request->region_id);
            $data['region_id']=$request->region_id;
            $data['city_id']=$city_id;
        }

        $user=User::find($request->id);

        $user->update($data);

        if($request->role_id){
            $user->removeRoles($user->roles->toArray());
            $role=Role::find($request->role_id);
            $user->addRole($role->name);
        }

        return response()->json([
            'status'=>true,
            'message'=>__('site.updateAdmin')
        ]);

    }


    public function destroy(string $id)
    {
        try {
            User::where('id',$id)->delete();
            session()->flash('success',__('site.delete_user'));
            return back();
        } catch (\Throwable $th) {
            session()->flash('error',__('site.canNotDeleteUser'));
            return back();
        }

    }
}
