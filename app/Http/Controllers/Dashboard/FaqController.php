<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends MainController
{

    public function index()
    {
        $faqs=Faq::filter(request('search'))->paginate(50);
        return view('admin.faq.index',compact("faqs"));
    }


    public function create()
    {
        return view('admin.faq.create');
    }


    public function store(FaqRequest $request)
    {
        Faq::create([
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
        session()->flash('success',__('site.createFaq'));
        return redirect()->route('faqs.index');
    }


    public function edit(Faq $faq)
    {
        return view('admin.faq.edit',compact('faq'));
    }


    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update([
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
        session()->flash('success',__('site.createFaq'));
        return redirect()->route('faqs.index');
    }


    public function destroy(string $id)
    {
        Faq::where('id',$id)->delete();
        session()->flash('success',__('site.deleteFaq'));
        return redirect()->route('faqs.index');
    }


    public function deleted(){
        $faqs=Faq::onlyTrashed()->filter(request("search"),true)->paginate(50);
        return view("admin.faq.deleted",compact("faqs"));
    }
    
    public function restore($faqId)
    {
        $faq = Faq::withTrashed()->findOrFail($faqId);
        $faq->restore();
        return back();
    }
}
