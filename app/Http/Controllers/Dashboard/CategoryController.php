<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\CategoryRequest;
use App\Http\Traits\AttributeTrait;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends MainController
{


    public function index()
    {
        $categories=Category::filter(request('search'))->paginate(50);
        return view("admin.category.index",compact('categories'));
    }

    // public function index(Request $request){
    //     if ($request->ajax()) {
    //         $categories=Category::latest();

    //         return DataTables::of($categories)
    //             ->addIndexColumn()
    //             ->addColumn('actions', function ($category) {
    //                 return view('admin.category.includes.actions', compact('category'))->render();
    //             })
    //             ->addColumn('status', function ($category) {
    //                 return view('admin.category.includes.status', compact('category'))->render();
    //             })
    //             ->editColumn('name', function ($category) {
    //                 return $category->nameLang();
    //             })
    //             ->rawColumns(['actions', 'status'])
    //             ->make(true);
    //     }

    //     return view("admin.category.index");
    // }







    public function store(CategoryRequest $request)
    {
        Category::create([
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


        return response()->json(['success'=>true,'message'=>('site.createCategory')]);
    }





    public function update(CategoryRequest $request)
    {
        $category=Category::findOrFail($request->id);
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

        return response()->json(['success'=>true,'message'=>('site.updateCategory')]);
    }


    public function destroy($id)
    {
        try {
            $item=Item::where('category_id',$id)->first();
            if($item){

                session()->flash('error',__('site.canNotDeleteCategory'));
                return back();

            }else{
                Category::where('id',$id)->delete();
                session()->flash('success',__('site.deleteCategory'));
                return back();
            }

        } catch (\Throwable $th) {
            session()->flash('error',__('site.canNotDeleteCategory'));
            return back();
        }
    }

}
