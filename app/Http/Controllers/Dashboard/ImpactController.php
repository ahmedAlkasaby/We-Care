<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Impact;
use App\Models\CharityCase;
use Illuminate\Http\Request;
use App\Http\Requests\ImpactRequest;
use App\Http\Controllers\MainController;

class ImpactController extends MainController
{


    public function index()
    {
        $impacts = Impact::filter(request("search"))->paginate(50);
        return view("admin.impact.index", compact("impacts"));
    }


    public function create()
    {
        $cases = CharityCase::get();
        $caseArr = [];

        foreach ($cases as $value) {
            $caseArr[$value->id] = $value->user->name;
        };
        return view('admin.impact.create', compact("caseArr"));
    }


    public function store(ImpactRequest $request)
    {
        // dd($request->case_id);
        $impact = Impact::create([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar
            ],
            'active' => $request->active,
            'case_id' => $request->case_id,
        ]);


        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {
                $newImagePath = $image->store('impact_images');
                $impact->images()->create(['image' => $newImagePath]);
            }
        }

        session()->flash('success', __('site.impactCreated'));
        return redirect()->route('impacts.index');
    }


    public function edit(string $id)
    {
        $cases = CharityCase::get();
        $caseArr = [];

        foreach ($cases as $value) {
            $caseArr[$value->id] = $value->user->name;
        };
        $impact = Impact::where('id', $id)->first();
        $name_ar=$impact->nameLang("ar");
        $name_en=$impact->nameLang("en");
        $description_ar=$impact->descriptionLang("ar");
        $description_en=$impact->descriptionLang("en");
        $active=$impact->active;
        return view('admin.impact.edit', get_defined_vars());
    }


    public function update(ImpactRequest $request, string $id)
    {
        $impact = Impact::where('id', $id)->first();
        $impact->update([
            'name' => [
                'en' => $request->name_en,
                'ar' => $request->name_ar
            ],
            'description' => [
                'en' => $request->description_en,
                'ar' => $request->description_ar
            ],
            'active' => $request->active,
            'case_id' => $request->case_id,
        ]);
        if ($request->hasFile('images')) {
            $imagesOld = $impact->images;
            foreach ($imagesOld as $image) {
                if ($image == 'impact_images/impactDefoult.jpeg') {
                } else {
                    unlink("uploads/" . $image->image);
                }
            }
            $impact->images()->delete();
            foreach ($request->file('images') as $image) {
                $newImagePath = $image->store('impact_images');
                $impact->images()->create(['image' => $newImagePath]);
            }
        }



        session()->flash('success', __('site.impactEdited'));
        return redirect()->route('impacts.index');
    }


    public function destroy(Impact $impact)
    {


        foreach ($impact->images as $image) {
            if ($image->image == 'impact_images/impactDefoult.jpeg') {
                break;
            }
            unlink("uploads/" . $image->image);
        }

        $impact->delete();
        session()->flash('success', __('site.impactDeleted'));
        return redirect()->route('impacts.index');
    }
   
    public function deleted(){
        $impacts=Impact::onlyTrashed()->filter(request("search"),true)->paginate(50);
        return view("admin.impact.deleted",compact("impacts"));
    }
    public function restore($impactId)
    {
    $impact = Impact::withTrashed()->findOrFail($impactId);
    $impact->restore();
    return back();
    }
}
