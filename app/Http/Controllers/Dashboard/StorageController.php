<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\Item;
use App\Models\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class StorageController extends Controller
{   
    public function show(){
        $cases=CharityCase::all();
        $cases_price_needed=0;
        foreach ($cases as $case) {
            $cases_price_needed+=($case->get_price() - $case->get_price_raised());
        }

        $donations=Donation::where('confirm',1)->get();
        $total_price_donation=0;
        foreach ($donations as $donation) {
            $total_price_donation+=$donation->get_price();
        }
        $data=[
            'storage'=>Storage::where('id',1)->first(),
            'items'=>Item::filter(request('search'))->paginate(50),
            'cases_price_needed'=>$cases_price_needed,
            'total_price_donation'=>$total_price_donation,
        ];
        return view("admin.storage.index",$data);
    }
}
