<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Slider;
use App\Models\CharityCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Controllers\MainController;

class   SliderController extends MainController
{

    public function index()
    {
        $sliders=Slider::filter(request("search"))->paginate(50);
        return view("admin.slider.index",compact("sliders"));
    }


    public function create()
    {
        $cases=CharityCase::get();
        $array=[];

        foreach($cases as $value){
            $array[$value->id] = $value->user->name;
        }
        return view('admin.slider.create',compact("array"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $newImagePath = $request->file('image')->store('slider_images');
        Slider::create([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar
            ],
            'description'=>[
                'en'=>$request->description_en,
                'ar'=>$request->description_ar
            ],
            'active'=>$request->has("active")?1:0,
            'case_id'=>$request->case_id,
            'image'=>$newImagePath,
        ]);




        session()->flash('success', __('site.sliderCreated'));
        return redirect()->route('sliders.index');
    }


    public function edit(string $id)
    {
        $slider=Slider::where('id',$id)->first();

        $cases=CharityCase::get();
        $array=[];

        foreach($cases as $value){
            $array[$value->id] = $value->user->name;
        }
        $name_ar=$slider->nameLang("ar");
        $name_en=$slider->nameLang("en");
        $description_ar=$slider->descriptionLang("ar");
        $description_en=$slider->descriptionLang("en");
        $active=$slider->active;
        return view('admin.slider.edit',get_defined_vars());
    }


    public function update(SliderRequest $request, string $id)
    {
        $slider=Slider::where('id',$id)->first();
        $slider->update([
            'name'=>[
                'en'=>$request->name_en,
                'ar'=>$request->name_ar
            ],
            'description'=>[
                'en'=>$request->description_en,
                'ar'=>$request->description_ar
            ],
            'active'=>$request->active,
            'case_id'=>$request->case_id,
        ]);
        if ($request->hasFile('image')) {
            if($request->image=='slider_images/defoultSlider.jpeg'){
            }else{
                unlink("uploads/".$slider->image);
            }
            $newImagePath = $request->file('image')->store('slider_images');
            $slider->image = $newImagePath;
            $slider->save();
        }


        session()->flash('success', __('site.sliderEdited'));
        return redirect()->route('sliders.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        // if ($slider->image == 'slider_images/defoultSlider.jpeg') {

        // }else{
        //     unlink("uploads/".$slider->image);
        // }
        $slider->delete();
        session()->flash('success', __('site.sliderDeleted'));
        return redirect()->back();
    }


   
    public function deleted(){
        $sliders = Slider::onlyTrashed()->whereNotNull('deleted_at')->filter(request("search"), true)->paginate(50);
        return view("admin.slider.deleted",compact("sliders"));
    }
    public function restore($sliderId)
    {
        $slider = Slider::withTrashed()->findOrFail($sliderId);
        $slider->restore();
        return back();
    }
}
