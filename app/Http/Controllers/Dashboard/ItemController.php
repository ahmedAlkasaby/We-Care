<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use App\Models\TypeStorage;
use Exception;

class ItemController extends MainController
{

    public function index()
    {
        $items=Item::filter(request('search'),request("category_id"))->paginate(50);
        $cats=Category::where('active',1)->get();
        $cats_array=$this->nameArray($cats);
        return view("admin.item.index",compact('cats','items','cats_array','cats'));
    }

    public function store(ItemRequest $request)
    {
        $item=Item::create([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description'=>[
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['success'=>true,'message'=>('site.createItem')]);
    }


    public function update(ItemRequest $request)
    {
        $item = Item::findOrFail($request->id);
        $item->update([
            'name'=>[
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ],
            'description'=>[
                'en' => $request->description_en,
                'ar' => $request->description_ar,
            ],
            'category_id' => $request->category_id,
            'price' => $request->price,
        ]);

        return response()->json(['success'=>true,'message'=>('site.updateItem')]);
    }
    public function destroy(Item $item){
        try{

            $item->delete();
        }catch(Exception $e){
            session()->flash('error',__('site.cantDelete'));
        return back();
        }
        session()->flash('success',__('site.deletedItem'));
        return back();
    }



}
