<?php

namespace App\Traits;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Storage;
use App\Models\TypeStorage;





trait PurchaseTrait{


    public function editStorageFromPurchases($purchaseId){
        $purchase=Purchase::find($purchaseId);
        $storage=Storage::find(1);
        $storage->update([
            'price'=>$storage->price + $purchase->total_price
        ]);
        foreach ($purchase->items as $item) {
            $item->update([
                'amount'=>$item->amount + $item->pivot->amount
            ]);
        }
    }

    public function storePurchace($items,$total_price){
        $purchase=Purchase::create();
        $storage=Storage::find(1);
        foreach ($items as $item) {
            $existingItem=$purchase->items()->where('item_id',$item['item_id'])->first();
            if($existingItem){
                $newAmount = $existingItem->pivot->amount + $item['amount'];
                $purchase->items()->updateExistingPivot($item['item_id'], ['amount' => $newAmount,'unit_price'=>$item['unit_price']]);
            }else{
                $purchase->items()->attach($item['item_id'],[
                    'amount'=>$item['amount'],
                    'unit_price'=>$item['unit_price']
                ]);
            }
            $existingItem=Item::find($item['item_id']);
            $existingItem->update(['price'=>$item['unit_price'],'amount'=>$existingItem->amount + $item['amount']]);

        }
        $purchase->update([
            'total_price'=>$total_price
        ]);
        $storage->update([
            'price'=>$storage->price-$total_price
        ]);
    }

}


