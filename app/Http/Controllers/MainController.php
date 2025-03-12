<?php

namespace App\Http\Controllers;

use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\Image;
use App\Models\Item;
use App\Models\Region;
use App\Models\Storage;
use App\Models\Transfer;
use App\Models\TypeStorage;
use App\Models\User;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function clearCache(){
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        return back()->with('success', __('site.cache_cleared_successfully'));
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

    public function nameArray( $model){
        $lang=App::getLocale();
        $array=[];

        foreach($model as $value){
            $array[$value->id] = $value->nameLang($lang);
        }
        return $array;

    }

    public function lang(){
        $userInfo=Auth::user();
        $user=User::where('id',$userInfo->id)->first();
        if($user->lang =="ar"){
            $user->update([
                'lang'=>'en'
            ]);
        }else{

            $user->update([
                'lang'=>'ar'
            ]);

        }
        return redirect()->back();
    }


    public function theme(){
        $userInfo=Auth::user();
        $user=User::where('id',$userInfo->id)->first();
        $user->update(['theme'=> ! ($user->theme)]);

        return redirect()->back();
    }



    public function getCityByRegion($region_id){
        $region=Region::find($region_id);
        $city_id=$region->city_id;
        return $city_id;
    }

    public function validationForTransferOrDonation($items,$price){
        // Custom validation logic
        if (empty($items) && empty($price)) {
            return redirect()->back()->withErrors(['validation' =>__('site.you_should_enter_price_or_items')]);
        }

        if (!empty($items) && !empty($price)) {
            return redirect()->back()->withErrors(['validation' => __('validation.you_cant_enter_both_price_and_items')]);
        }

        if (isset($items) && collect($items)->filter(function ($item) {
            return isset($item['amount']) && $item['amount'] >= 1;
        })->isEmpty()) {
            return back()->withErrors(['items' => 'يجب أن يكون هناك عنصر واحد على الأقل بكمية صحيحة.'])->withInput();
        }
    }


    public function toggle(Request $request ,$id){
        $routeName=$request->route()->getName();
        $tableName = Str::before($routeName, '.toggle');
        $record=DB::table($tableName)->where('id',$id)->first();
        DB::table($tableName)->where('id', $id)->update(['active' => ! $record->active]);
        return back();
    }








}
