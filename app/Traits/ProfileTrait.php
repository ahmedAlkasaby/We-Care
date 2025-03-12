<?php

namespace App\Traits;

use App\Http\Resources\DonationCollection;
use App\Http\Resources\DonationResource;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait ProfileTrait {
    public function donations($is_event,$method,$is_confirm){
        $auth = Auth::guard('api')->user();
        $user = User::find($auth->id);
        $donations=$user->donations()->with('case')->where('confirm',$is_confirm)->whereHas('case', function($query) use($is_event,$method) {
            $query->where('is_event', $is_event);
        })->$method();

        return $method =='get'? DonationResource::collection($donations) : $donations;
    }
   




}

