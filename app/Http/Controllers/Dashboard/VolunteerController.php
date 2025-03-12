<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\VolunteerRequest;
use App\Models\Volunteer;
use Exception;

class VolunteerController extends MainController
{
   

    public function index()
    {
        $volunteers=User::where('role','volunteer')->filter(request('search'))->paginate(50);
        $cities=City::all();
        $regions=Region::all();
        return view('admin.volunteer.index',compact('volunteers','regions','cities'));
    }


    public function store(VolunteerRequest $request)
    {

        $city_id=$this->getCityByRegion($request->region_id);

        $volunteer=User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'city_id'=>$city_id,
            'region_id'=>$request->region_id,
            'cases'=>0,
            'role'=>'volunteer',
            "lang"=>$request->lang,
            'gender'=>$request->gender,
            'password'=>Hash::make($request->phone),
        ]);
        $volunteer->addRole('volunteer');
        return response()->json(['success'=>true,'message'=>('site.createVolunteer')]);
    }


    public function update(VolunteerRequest $request)
    {
            $volunteer = User::findOrFail($request->id);

            $city_id=$this->getCityByRegion($request->region_id);
            $volunteer->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                "lang"=>$request->lang,
                'city_id'=>$city_id,
                'region_id'=>$request->region_id,
                'password'=>$request->password ? Hash::make($request->phone): $volunteer->password,
            ]);

            return response()->json([
                'status'=>true,
                'message'=>__('site.updateVoluneteer')
            ]);
    }

    public function destroy($id)
    {

        try {
            $volunteer = User::findOrFail($id);
            if ($volunteer->cases > 0) {
                session()->flash('error',__('site.canNotDeleteVolunteer'));
                return back();
            }
           $volunteer->delete();
            session()->flash('success',__('site.delete_Volunteer'));
            return back();
        } catch (\Throwable $th) {
            session()->flash('error',__('site.canNotDeleteVolunteer'));
            return back();
        }
    }
}
