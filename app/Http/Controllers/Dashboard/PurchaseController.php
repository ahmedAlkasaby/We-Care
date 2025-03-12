<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Storage;
use App\Models\TypeStorage;
use App\Traits\PurchaseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use PurchaseTrait;
 


    public function index()
    {
        $purchases=Purchase::paginate(50);
        $categories=Category::all();

        $storage_money=Storage::find(1)->price;
        $purchase_items=Purchase::count('total_price');
        $purchase_items_last_month = Purchase::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('total_price');

        $total_purchase_money=Purchase::sum("total_price");

        return view('admin.purchase.index',get_defined_vars());
    }


    public function store(PurchaseRequest $request)
    {
        $request->validated();
        $total_price=0;
        foreach ($request->items as $item) {
            $total_price+=($item['amount'] * $item['unit_price']);
        }
        $storage=Storage::find(1);
        if($total_price >$storage->price){
            session()->flash('error',('site.TotalPriceBiggerThanStoragePrice'));
            return back();
        }else{
            $this->storePurchace($request->items,$total_price);
            session()->flash('success',('site.CreatePurchase'));
            return back();
        }

    }


    // public function update(PurchaseRequest $request, Purchase $purchase)
    // {
    //     $request->validated();

    //     $this->editStorageFromPurchases($purchase->id);

    //     $purchase->items()->detach();

    //     $total_price=0;
    //     foreach ($request->items as $item) {
    //         $total_price+=($item['amount'] * $item['unit_price']);
    //     }
    //     $storage=Storage::find(1);

    //     if($total_price > $storage->price){
    //         $purchase->delete();
    //         session()->flash('error',('site.TotalPriceBiggerThanStoragePrice'));
    //         return back();
    //     }else{
    //         foreach ($request->items as $item) {
    //             $existingItem=$purchase->items()->where('item_id',$item['item_id'])->first();
    //             if($existingItem){
    //                 $newAmount = $existingItem->pivot->amount + $item['amount'];
    //                 $purchase->items()->updateExistingPivot($item['item_id'], ['amount' => $newAmount,'unit_price'=>$item['unit_price']]);
    //             Item::where('id',$item['item_id'])->update(['price'=>$item['unit_price'],'amount'=>$item->amount + $item['amount']]);

    //             }else{
    //                 $purchase->items()->attach($item['item_id'],[
    //                     'amount'=>$item['amount'],
    //                     'unit_price'=>$item['unit_price']
    //                 ]);
    //                 Item::where('id',$item['item_id'])->update(['price'=>$item['unit_price'],'amount'=>$item['amount']]);

    //             }
    //         }
    //         $purchase->update([
    //             'total_price'=>$total_price
    //         ]);
    //         $storage->update([
    //             'price'=>$storage->price-$total_price
    //         ]);

    //         session()->flash('success',('site.UpdatePurchase'));
    //         return back();
    //     }


    // }


    public function destroy(string $id)
    {
        $purchase=Purchase::find($id);
        $this->editStorageFromPurchases($purchase->id);

        $purchase->items()->detach();

        $purchase->delete();

        session()->flash('success',('site.deletePurchases'));
        return back();

    }
}
