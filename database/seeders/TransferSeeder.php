<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
use App\Models\Donation;
use App\Models\Transfer;
use App\Models\CharityCase;
use App\Models\TypeStorage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransferSeeder extends Seeder
{

    public function run(): void
    {
        // for ($i=0; $i < 500; $i++) {
        //     $case= CharityCase::inRandomOrder()->first();
        //     if($case->price_raised < $case->price){

        //         $transfer=Transfer::create([
        //             'case_id'=>$case->id
        //         ]);

        //         if($case->items->count()>0){
        //             // $total_price=0;

        //             foreach ($case->items as $item) {
        //                 $rand_amount=rand(0,$item->pivot->amount - $item->pivot->amount_raised);
        //                 if($rand_amount >0){
        //                     $pivotRecord=$case->items()->wherePivot('item_id',$item->id)->first();
        //                     if ($pivotRecord->pivot->amount_raised < $pivotRecord->pivot->amount) {
        //                         $transfer->items()->attach($item->id, ['amount' =>$rand_amount,'price'=>$item->price * $rand_amount]);

        //                         $case->items()->updateExistingPivot($item->id, ['amount_raised' => $pivotRecord->pivot->amount_raised +$rand_amount]);
        //                         $total_price = ($item->price * $rand_amount);
        //                         $transfer->update([
        //                             'price'=>$total_price
        //                         ]);
        //                         $case->update([
        //                             'price_raised'=>$case->price_raised + $total_price
        //                         ]);

        //                     }

        //                 }

        //             }

        //         }else{
        //             $rand_price=rand(0,$case->price-$case->price_raised);
        //             $transfer->update([
        //                 'price'=>$rand_price
        //             ]);
        //             $case->update([
        //                 'price_raised'=>$case->price_raised + $rand_price
        //             ]);

        //         }

        //         $caseUpdated=CharityCase::find($case->id);

        //         if($caseUpdated->price_raised >= $caseUpdated->price ){
        //             $caseUpdated->update([
        //                 'active'=>0,
        //                 'archive'=>1
        //             ]);
        //         }
        //     }
        // }

        for ($i = 0; $i < 10; $i++) {
            $donation = Donation::inRandomOrder()->first();
            $transfer = Transfer::create([
                'donation_id' => $donation->id,
                'case_id' => CharityCase::inRandomOrder()->first()->id,
                'price' => rand(100, min($donation->price, 1000)),
                'created_at' => now()->subDays($i) // This line ensures the created_at field varies around the past 10 days
            ]);
        }
    }
}
