<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends MainController
{

    public function index()
    {
        $pages=Page::filter(request('search'))->orderBy('id','desc')->paginate(5);
        return view('admin.page.index',compact('pages'));
    }


    public function create()
    {
        return view('admin.page.create');
    }

    public function store(PageRequest $request)
    {

        Page::create([
            'name'=>[
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'description'=>[
                'ar' => $request->description_ar,
                'en' => $request->description_en,
            ],
        ]);
        session()->flash('success',__('site.createPage'));
       return redirect()->route('pages.index');
    }


    public function edit(string $id)
    {
        $page=Page::find($id);
        return view('admin.page.edit',compact('page'));
    }


    public function update(PageRequest $request, Page $page)
    {


        $page->update([
            'name'=>[
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],
            'description'=>[
                'ar' => $request->description_ar,
                'en' => $request->description_en,
            ],
        ]);
        session()->flash('success',__('site.updatePage'));
       return redirect()->route('pages.index');
    }


    public function destroy(string $id)
    {
        Page::where('id',$id)->delete();
        session()->flash('success',__('site.deletePage'));
        return redirect()->route('pages.index');
    }
    
    public function deleted(){
        $pages=Page::onlyTrashed()->filter(request("search"),true)->paginate(50);
        return view("admin.page.deleted",compact("pages"));
    }
    public function restore($pageId)
    {
    $page = page::withTrashed()->findOrFail($pageId);
    $page->restore();
    return back();
    }
}
