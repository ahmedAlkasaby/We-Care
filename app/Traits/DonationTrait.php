<?php

namespace App\Traits;

use App\Models\Donation;
use App\Models\Item;
use App\Models\Storage;
use App\Models\TypeStorage;
use App\Models\User;

trait DonationTrait{
    public function donationByPrice($doner_id,$price,$case_id=null){
        $donation=Donation::create([
            'doner_id'=>$doner_id,
            'payment_id'=>1,
            'case_id'=>$case_id,
            'price'=>$price,
            'confirm'=>1,
            'type'=>'price',
        ]);
        $storage=Storage::find(1);
        $storage->update([
            'price'=>$storage->price + $price
        ]);
        $doner=User::find($doner_id);
        $doner->update([
            'amount'=>$doner->amount + $donation->price
        ]);
        $donation->images()->create([
            'image'=>'donation_images\donation_from_charity.png'
        ]);
    }

    public function donationByItems($doner_id,$items,$case_id=null){
        $donation=Donation::create([
            'doner_id'=>$doner_id,
            'payment_id'=>1,
            'case_id'=>$case_id,
            'confirm'=>1,
            'type'=>'items',


        ]);
        foreach ($items as $item) {
            $donation->items()->attach($item['item_id'], [
                'amount' => $item['amount'],
                // 'remain_amount'=>$item['amount'],
            ]);
            $item=Item::find($item['item_id']);
            $item->update([
                'amount'=>$item->amount + $item['amount']
            ]);
        }
        $donation->images()->create([
            'image'=>'donation_images\donation_from_charity.png'
        ]);
    }

    public function addDonateMoneyToDoner($donation_id){
        $donation=Donation::find($donation_id);
        $doner=User::find($donation->doner_id);
        $doner->update([
            'amount'=> $doner->amount + $donation->price
        ]);

    }

    public function MultiImages($images,$donation_id){
        $donation=Donation::find($donation_id);
        foreach ($images as $image) {
            $path = $image->store('donation_images');
            $donation->images()->create(['image'=>$path]);
        }
    }

    public function confirmDonation($donation_id,$items){
        $donation=Donation::find($donation_id);
        if ($donation->type == 'items') {

            foreach ($items as $item) {
                $donation->items()->attach($item['item_id'], [
                    'amount' => $item['amount'],

                ]);
                $item=Item::find($item['item_id']);
                $item->update([
                    'amount'=>$item->amount + $item['amount']
                ]);
            }
        }else{
            $storage=Storage::find(1);
            $storage->update([
                'price'=>$storage->price + $donation->price
            ]);
            $doner=User::find($donation->doner_id);
            $doner->update([
                'amount'=>$doner->amount + $donation->price
            ]);
        }

        $donation->update([
            'confirm'=>1
        ]);

    }


}
