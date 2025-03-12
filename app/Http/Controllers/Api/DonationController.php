<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DonationCollection;
use App\Http\Resources\DonationResource;
use App\Models\Donation;
use App\Models\User;
use App\Notifications\DatabaseNotification;
use App\Traits\DonationTrait;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DonationController extends MainController
{
    use DonationTrait;

    public function index(){
        $auth=Auth::guard('api')->user();
        $user=User::find($auth->id);
        return $this->sendData(new DonationCollection($user->donations()->paginate(10)));
    }


    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'price'=>'required_if:type,price|numeric|min:1',
            'case_id'=>'nullable|exists:charity_cases,id',
            'images'=>'required|array|min:1',
            // 'images.*' => 'required|array|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type'=>'required|in:items,price',
            'description'=>'required_if:type,items|string|max:255'
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }
        $auth=Auth::guard('api')->user();


        $donation=Donation::create([
            'doner_id'=>$auth->id,
            'price'=>$request->price ? $request->price : 0,
            'confirm'=>0,
            'payment_id'=>1,
            'case_id'=>$request->case_id ? $request->case_id : null,
            'type'=> $request->type,
            'description'=> $request->description ? $request->description : null,
        ]);
        $this->MultiImages($request->images,$donation->id);

        $admins=User::where('is_admin',1)->get();
        Notification::send($admins,new DatabaseNotification('تمت عمليه تبرع  من علي التطبيق ','The Donation Created From App',null,$donation->case_id ));


        return $this->sendData(null,__('site.create_donation_api'));

    }
}
