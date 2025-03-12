<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Storage;
use App\Models\Donation;
use App\Models\Transfer;
use App\Models\CharityCase;
use App\Models\TypeStorage;

trait TransferTrait{

    public function total_price_for_transfers_with_items(){
        $transfers=Transfer::wherehas("items")->get()->sum(function($transfer){
            return $transfer->items->sum(function($item){
                return $item->price * $item->pivot->amount;
            });
        });
        return $transfers;
    }

    public function calculateNextDonationDateWithTransfer($repeating,$next_donation)
    {
        $next_donation = Carbon::parse($next_donation);
        if ($repeating == 'daily') {
            return  $next_donation->addDay();
        } elseif ($repeating == 'weekly') {
            return $next_donation->addWeek();
        } elseif ($repeating == 'monthly') {
            return $next_donation->addMonth();
        } elseif ($repeating == 'yearly') {
            return $next_donation->addYear();
        } else {
            return null;
        }

    }

    public function transferByItems($case_id,$items,$transfer_id){
        $case=CharityCase::find($case_id);


        $transferCreated=Transfer::find($transfer_id);
        $transferCreated->update([
            'type'=>'items'
        ]);
        foreach ($items as $itemId => $itemData) {
            $item=Item::find($itemId);
            if ($itemData['amount'] >0) {
                $transferCreated->items()->attach($itemId, ['amount' => $itemData['amount']]);

                $item->update([
                    'amount'=>$item->amount - $itemData['amount']
                ]);
                $pivotRecord=$case->items()->wherePivot('item_id',$itemId)->first();
                $case->items()->updateExistingPivot($itemId, ['amount_raised' => $pivotRecord->pivot->amount_raised +$itemData['amount']]);

            }

        }
    }

    public function transferByItemsByDonation($case_id,$items,$transfer_id,$donation_id){
        $case=CharityCase::find($case_id);
        $donation=Donation::find($donation_id);
        $transferCreated=Transfer::find($transfer_id);
        $transferCreated->update([
            'type'=>'items'
        ]);

        foreach ($items as $itemId => $itemData) {
            if ($itemData['amount'] >0) {
                $item=Item::find($itemId);
                if ($itemData['amount'] >0) {
                    $transferCreated->items()->attach($itemId, ['amount' => $itemData['amount']]);


                    $item->update([
                        'amount'=>$item->amount - $itemData['amount']
                    ]);
                    $pivotRecord=$case->items()->wherePivot('item_id',$itemId)->first();
                    $case->items()->updateExistingPivot($itemId, ['amount_raised' => $pivotRecord->pivot->amount_raised +$itemData['amount']]);

                    $pivotRecord = $donation->items()->wherePivot('item_id', $itemId)->first();
                    if($pivotRecord){
                        $donation->items()->updateExistingPivot($itemId, ['doner_amount' =>$pivotRecord->pivot->doner_amount + $itemData['amount']]);
                    }
                }
            }
        }

    }

    public function transferByPrice($case_id,$price,$transfer_id){
        $case=CharityCase::find($case_id);
        $storage=Storage::find(1);
        $transferCreated=Transfer::find($transfer_id);

        $transferCreated->update([
            'price'=>$price,
        ]);
        $storage->update([
            'price'=>$storage->price - $price
        ]);
        $case->update([
            'price_raised'=>$case->get_price_raised() + $price
        ]);
    }
    public function transferByPriceByDonation($case_id,$price,$transfer_id,$donation_id){
        $case=CharityCase::find($case_id);
        $donation=Donation::find($donation_id);
        $storage=Storage::find(1);
        $transferCreated=Transfer::find($transfer_id);

        $transferCreated->update([
            'price'=>$price,
        ]);
        $storage->update([
            'price'=>$storage->price - $price
        ]);
        $case->update([
            'price_raised'=>$case->get_price_raised() + $price
        ]);

        $donation->update([
            'doner_price'=>$donation->get_doner_price()+$transferCreated->price
        ]);
    }


    public function deleteTransferByItems($transfer_id,$donation_id=null){
        $transfer=Transfer::find($transfer_id);
        $case=CharityCase::find($transfer->case_id);
        if($donation_id){
            $donation=Donation::find($donation_id);
        }
        foreach ($transfer->items as $item) {
            $item->update([
                'amount'=>$item->amount + $item->pivot->amount
            ]);
            $pivotCase = $case->items()->where('item_id', $item->id)->first();
            $pivotTransfer=$transfer->items()->where('item_id',$item->id)->first();
            if ($donation_id) {
                $pivotDonation=$donation->items()->where('item_id',$item->id)->first();
            }

            $case->items()->updateExistingPivot($item->id, ['amount_raised' => $pivotCase->pivot->amount_raised - $pivotTransfer->pivot->amount]);
            if($donation_id){

                if ($pivotDonation && $pivotDonation->pivot && $pivotDonation->pivot->doner_amount != null) {
                    $donation->items()->updateExistingPivot($item->id, ['doner_amount' => $pivotDonation->pivot->doner_amount - $pivotTransfer->pivot->amount]);
                }
            }
        };
        $case->update([

            'active'=>1
        ]);


        $transfer->items()->detach();
        $transfer->delete();
    }


    public function deleteTransferByPrice($transfer_id,$donation_id=null){
        $transfer=Transfer::find($transfer_id);
        // storage

        $storage=Storage::find(1);

        $storage->update([
            'price'=>$storage->price+ $transfer->get_price()
        ]);
        // case
        $case=CharityCase::find($transfer->case_id);
        $case->update([
            'price_raised'=>$case->get_price_raised() - $transfer->get_price(),
            'active'=>1
        ]);
        if($donation_id){
            // donation
            $donation=Donation::find($transfer->donation_id);
            $donation->update([
                'doner_price'=>$donation->get_doner_price() - $transfer->get_price()
            ]);
        }
        $transfer->items()->detach();
        $transfer->delete();
    }


    public function check_archive($case_id){
        $caseUpdated=CharityCase::find($case_id);

        if ($caseUpdated->repeating != 'none') {
            if ($caseUpdated->get_price_raised() >= $caseUpdated->get_price() ) {
                $caseUpdated->update([
                    'next_donation_date'=>$this->calculateNextDonationDateWithTransfer($caseUpdated->repeating,$caseUpdated->next_donation_date),
                    'price_raised'=>0,
                    'active'=>0
                ]);
            }
        }else {
            if($caseUpdated->get_price_raised()  >= $caseUpdated->get_price() ){
                $caseUpdated->update([
                    'active'=>0,
                    'archive'=>1
                ]);
                // تحديث التبرعات المرتبطة
                if ($caseUpdated->donations()->exists()) {
                    $caseUpdated->donations()->update(['archive' => 1]);
                }

                // تحديث التحويلات المرتبطة
                if ($caseUpdated->transfers()->exists()) {
                    $caseUpdated->transfers()->update(['archive' => 1]);
                }
            }
        }
    }
}


