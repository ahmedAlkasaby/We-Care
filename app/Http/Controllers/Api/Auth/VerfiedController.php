<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerfyEmail;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerfiedController extends MainController
{
    private $otp;
    public function __construct() {
        $this->otp=new Otp;
    }

    public function resendCode(Request $request){

        $validator=Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email',
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }

        $user=User::where('email',$request->email)->first();

        $user->notify(new VerfyEmail($request->email));

        return $this->sendData([], 'resend code successfully');


    }

    public function verfiedEmail(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email',
            'code'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }


        $otp=$this->otp->validate($request->email,$request->code);

        if($otp->status==true){
            User::where('email',$request->email)->update([
                'email_verified_at'=>now()
            ]);
            return $this->sendData([], 'the email verfied successfully');
        }else{
            return $this->massageError($otp->message,400);
        }
    }
}
