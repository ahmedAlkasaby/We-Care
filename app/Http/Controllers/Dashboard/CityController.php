<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\CityRequest;
use App\Models\City;

class CityController extends MainController
{

    public function index(){
        $cities = City::filter(request('search'))->latest()->paginate(50);
        return view('admin.city.index', compact('cities'));
    }

    public function store(CityRequest $request){
        City::create([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'active'=>$request->active,
        ]);
        return response()->json(['success'=>true,'message'=>('site.createCity')]);
    }

    public function update(CityRequest $request){
        $city = City::findOrFail($request->id);
        $city->update([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'active'=>$request->active,

        ]);
        return response()->json(['success'=>true,'message'=>('site.updateCity')]);
    }

    public function destroy(City $city){
        if ($city->regions()->count() > 0  && $city->users()->count() > 0) {
            session()->flash('error', __('site.CityCantBeDeleted'));
            return redirect()->back();
        }
        $city->delete();
        session()->flash('success', __('site.cityDeleted'));
        return redirect()->back();
    }
}
