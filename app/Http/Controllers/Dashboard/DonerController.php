<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\User;
use App\Models\Region;
use App\Models\Storage;
use App\Models\Category;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\VolunteerRequest;
use App\Http\Controllers\MainController;

class DonerController extends MainController
{
   
    public function index()
    {
        $doners=User::where('role',"LIKE",'doner')->filter(request('search'))->paginate(50);
        $cities=City::all();
        $regions=Region::all();
        return view('admin.doner.index',compact('doners','regions','cities'));
    }


    public function store(VolunteerRequest $request)
    {
        $city_id=$this->getCityByRegion($request->region_id);

        $doner=User::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'city_id'=>$city_id,
            'region_id'=>$request->region_id,
            'role'=>'doner',
            "lang"=>$request->lang,
            'password'=>Hash::make($request->phone),
        ]);

        return response()->json([
            'status'=>true,
            'message'=>__('site.createDoner')
        ]);


    }


    public function update(VolunteerRequest $request)
    {

        $user = User::findOrFail($request->id);

        $city_id=$this->getCityByRegion($request->region_id);

        $user->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'city_id'=>$city_id,
            'region_id'=>$request->region_id,
            "lang"=>$request->lang,
            'password'=>$request->password ?Hash::make($request->phone): $user->password,
        ]);
        if(!$request->operationType){
            session()->flash('success',__('site.updateDoner'));
            return redirect()->back();
        }
        return response()->json([
            'status'=>true,
            'message'=>__('site.updateDoner')
        ]);
    }


    public function destroy($id)
    {
        try {
            $doner=User::find($id);
            if ($doner->amount > 0) {
                session()->flash('error',__('site.canNotDeleteDoner'));
                return back();
            }
            User::where('id',$id)->delete();
            session()->flash('success',__('site.delete_Doner'));
            return back();
        } catch (\Throwable $th) {
            session()->flash('error',__('site.canNotDeleteDoner'));
            return back();
        }
    }
    public function show(User $doner){
        $city=City::where("id",$doner->city_id)->first()->nameLang();
        $region=Region::where("id",$doner->region_id)->first()->nameLang();
        $cities=City::get();
        $regions=Region::get();
        $donations=Donation::where("doner_id",$doner->id)->paginate(10);
        $cases=Donation::where('doner_id', $doner->id)
        ->distinct('case_id')
        ->count();
        $categories=Category::all();
        $storage=Storage::find(1);
        return view("admin.doner.show",compact("doner","city","region","cities","regions",'donations',"cases","categories","storage"));
    }



    public function updatePassword(Request $request,string $id){
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user=User::find($id);


        $user->update([
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', __('site.Password updated successfully'));
        return redirect()->back();

}

}
