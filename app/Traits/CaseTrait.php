<?php

namespace App\Traits;

use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\Image;
use App\Models\Item;
use App\Models\User;
use App\Models\Volunteer;
use App\Services\UploadImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait CaseTrait
{
    public function check_case_in_likes($case_id){
        $case_id = $case_id;
        if(Auth::guard('api')->check()){
            $auth=Auth::guard('api')->user();
            $user=User::find($auth->id);
            $check = $user->likeCases()->where('case_id', $case_id)->first();
            if ($check) {
                return 'yes';
            }else{
                return 'no';
            }
        }
        return 'no';
    }

    public function check_donation_for_this_case($case_id){
        if(Auth::guard('api')->check()){
            $auth=Auth::guard('api')->user();
            $user=User::find($auth->id);
            $checkDonation = Donation::where('case_id',$case_id)->where('doner_id',$user->id)->first();
            if ($checkDonation) {
                return 'yes';
            }else{
                return 'no';
            }
        }
        return 'no';
    }

    public function check_donation_for_this_case_and_get_price($case_id){
        $case_id = $case_id;
        if(Auth::guard('api')->check()){
            $auth=Auth::guard('api')->user();
            $user=User::find($auth->id);
            $checkDonation = Donation::where('case_id',$case_id)->where('doner_id',$user->id)->get()->sum(function($donation){
                return $donation->price;
            });
            if ($checkDonation) {
                return $checkDonation;
            }else{
                return '0.00';
            }
        }
        return '0.00';
    }

    public function remainingDaysUntilEnd(): ?int
    {
        if ($this->date_end) { // تحقق من وجود تاريخ انتهاء
            return Carbon::parse($this->date_end)->diffInDays(Carbon::now());
        }
        return '0'; // إرجاع null إذا لم يكن هناك تاريخ انتهاء
    }

    public function getVolunteersWithArray(){
        $volunteers=User::where('role','volunteer')->get();
        $volunteersOptions = $volunteers->pluck('name', 'id')->map(function($name, $id) use ($volunteers) {
            return __('site.name') . ': ' . $name . '  ////  ' . __('site.phone') . ': ' . $volunteers->find($id)->phone;
        });
        return $volunteersOptions;
    }

    public function getVolunteersWithArrayWithFilter(){
        $volunteers=User::where('role','volunteer')->get();
        $volunteersOptions = $volunteers->pluck('name', 'id')->map(function($name, $id) use ($volunteers) {
            return __('site.name') . ': ' . $name . '  ////  ' . __('site.phone') . ': ' . $volunteers->find($id)->phone;
        });
        $volunteersOptions->prepend(('site.select_volunteer'),null);
        return $volunteersOptions;
    }

    public function MultiImages($images,$case_id,$type,UploadImage $UploadImage){
        $case=CharityCase::find($case_id);

        if($type=='update'){
            $imagesOld=$case->images;
            foreach ($imagesOld as $image) {
                unlink('uploads/' . $image->image);
            }
            $case->images()->delete();
        }

        foreach ($images as $image) {
            $path = $UploadImage->uploadImage($image, 'case_images');
            $case->images()->create(['image' => $path]);
        }
    }

    public function CaseItems($items,$case_id,$typeCase){
        $case=CharityCase::find($case_id);

        if($typeCase=='update'){
            $case->items()->detach(); // إزالة العناصر القديمة
        }

        foreach ($items as $item) {
            if (isset($item['item_id']) && isset($item['amount']) && $item['amount'] > 0) {
                $existingItem = $case->items()->where('item_id', $item['item_id'])->first();
                if ($existingItem) {
                    $newAmount = $existingItem->pivot->amount + $item['amount'];
                    $case->items()->updateExistingPivot($item['item_id'], ['amount' => $newAmount]);

                }else{
                    $case->items()->attach($item['item_id'], [
                        'amount' => $item['amount'],
                        'amount_raised' => 0,
                    ]);
                }
            }
        }


    }

    public function calculateNextDonationDate($repeating)
    {
        if ($repeating == 'daily') {
            return  Carbon::now()->addDay();
        } elseif ($repeating == 'weekly') {
            return Carbon::now()->addWeek();
        } elseif ($repeating == 'monthly') {
            return Carbon::now()->addMonth();
        } elseif ($repeating == 'yearly') {
            return Carbon::now()->addYear();
        } else {
            return null;
        }

    }

    public function calculateTotalPriceForCasesNeededMoney(){
        $total_price= CharityCase::where('active', 1)
        ->whereColumn('price_raised',"<",'price')
        ->where("type",'price')
        ->sum('price');
        $price_raised= CharityCase::where('active', 1)
        ->whereColumn('price_raised',"<",'price')
        ->where("type",'price')
        ->sum('price_raised');

        $price_need=$total_price- $price_raised;
        return $price_need;
    }

    public function calculateTotalPriceForCasesNeededItems(){
        $total_price = CharityCase::where('active', 1)
            ->with('items')
            ->where('type', 'items')
            ->whereHas('items')
            ->get()
            ->sum(function($case) {
                return $case->items->sum(function($item) {
                    return $item->pivot->amount * $item->price;
                });
            });

        $price_raised = CharityCase::where('active', 1)
            ->with('items')
            ->where('type', 'items')
            ->whereHas('items')
            ->get()
            ->sum(function($case) {
                return $case->items->sum(function($item) {
                    return $item->pivot->amount_raised * $item->price;
                });
            });

        $price_need = $total_price - $price_raised;

        return $price_need;
    }


    public function donationsConfirmTotalPrice($case_id){
        $case=CharityCase::find($case_id);
        $donationsConfirm=Donation::where('case_id',$case_id)->where('confirm',1)->get();
        $total_price=$donationsConfirm->sum(function($donation){
           return $donation->price;
        });
        return $total_price;
    }

    public function donationsPenddingTotalPrice($case_id){
        $case=CharityCase::find($case_id);
        $donationsPendding=Donation::where('case_id',$case_id)->where('confirm',0)->get();
        $total_price=$donationsPendding->sum(function($donation){
            return $donation->price;
        });
        return $total_price;
    }


    public function can_donation_for_this_case($case_id){
        $case=CharityCase::find($case_id);


        $price_waiting=Donation::where('case_id',$case_id)->where('confirm',0)->get()->sum(function($donation){
            return $donation->price;
        });
        $price=$case->price;
        $price_raised=$case->price_raised;
        $price_need=$price-$price_raised;

        $price_expect=$price_waiting+$price_raised;
        // dd($price_need);


        if ($price_expect < $price_need && ($case->end_date >= now() || $case->end_date == null)) {
            return 'yes';
        }else{
            return 'no';
        }

    }


}
