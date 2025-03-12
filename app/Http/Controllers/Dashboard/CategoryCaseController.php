<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\CategoryRequest;
use App\Models\CategoryCase;
use App\Models\CharityCase;
use Illuminate\Http\Request;

class CategoryCaseController extends MainController
{

    public function index()
    {
        $categories=CategoryCase::filter(request('search'))->paginate(50);

        return view("admin.category_case.index",compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        CategoryCase::create([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description'=>[
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'active' => $request->active,
        ]);

        return response()->json(['success'=>true,'message'=>('site.createCategoryCase')]);

    }


    public function update(CategoryRequest $request)
    {
        $category=CategoryCase::findOrFail($request->id);
        $category->update([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description'=>[
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'parent_category'=>$request->parent_category??null,
            'active' => $request->active,
        ]);

        return response()->json(['success'=>true,'message'=>('site.updateCategoryCase')]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {


        try {
            $case=CharityCase::where('category_case_id',$id)->first();
            if($case){

                session()->flash('error',__('site.canNotDeleteCategory'));
                return back();

            }else{
                CategoryCase::where('id',$id)->delete();
                session()->flash('success',__('site.deleteCategoryCase'));
                return back();
            }

        } catch (\Throwable $th) {
            session()->flash('error',__('site.canNotDeleteCategory'));
            return back();
        }
    }
   
}
