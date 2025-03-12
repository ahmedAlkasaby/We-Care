<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\RegionRequest;

class RegionController extends MainController
{

    public function index(){
        $regions = Region::filter(request('search'))->latest()->paginate(50);
        $cities = City::where('active',1)->get();
        $cities_array = $this->nameArray($cities);
        return view('admin.region.index', compact('cities', 'regions',"cities_array"));
    }

    public function store(RegionRequest $request){
        Region::create([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'city_id' => $request->city_id,
            'active' => $request->active,
        ]);

        return response()->json(['success'=>true,'message'=>('site.createRegion')]);
    }

    public function update(RegionRequest $request){
        $region = Region::findOrFail($request->id);
        $region->update([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'city_id' => $request->city_id,
            'active'=>$request->active,

        ]);

        return response()->json(['success'=>true,'message'=>('site.updateRegion')]);
    }

    public function destroy(Region $region){
        if ($region->users()->count() > 0 && $region->users()->count() > 0) {
            session()->flash('error', __('site.regionCantBeDeleted'));
            return redirect()->back();
        }
        $region->delete();
        session()->flash('success', __('site.region deleted successfully'));
        return redirect()->back();
    }

}
