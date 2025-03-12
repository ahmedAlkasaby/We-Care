<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\RegisterMail;
use App\Notifications\VerfyEmail;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\InvalidIdToken;


class AuthController extends MainController
{



    public function check_register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ]);
        if ($validator->fails()) {
           return $this->sendError('error',$validator->errors(),403);
        }

        Notification::route('mail', $request->email)
        ->notify((new VerfyEmail($request->email))->delay(now()->addMinutes(1)));


        return $this->sendData(null,'send otp successfully');
    }



    public function register(Request $request){

        $validator=Validator::make($request->all(),[
            'email'=>'required|email|unique:users|max:255|string',
            'password'=>'required|confirmed|min:8|string',
            'code'=>'required',
            'token'=>'required|string',
            'device_type'=>'required|string|in:android,huawei,apple',
            'imei'=>'required|string',
           
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }
        $otp=(new Otp)->validate($request->email, $request->code);


        if($otp->status==true){
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at'=>now(),
                'role'=>'doner',
                'is_admin'=>0,

            ]);

            $user->addRole('doner');

            $user->devices()->create([
                'token'=>$request->token,
                'device_type'=>$request->device_type,
                'imei'=>$request->imei
            ]);

            $token = Auth::guard('api')->login($user);
        }else{
            return $this->massageError($otp->message,400);
        }

        return $this->sendData([
            'user' => new UserResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 'Register Successfully');
    }




    public function login(Request $request){

        $validator=Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email',
            'password'=>'required|min:8',
            'token'=>'required|string',
            'device_type'=>'required|string|in:android,huawei,apple',
            'imei'=>'required|string'
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }

        $credentials = $request->only('email', 'password');
        $token=Auth::guard('api')->attempt($credentials);
        if (!$token) {
            return $this->massageError('Unauthorized', 400);
        }
        $auth = Auth::guard('api')->user();

        $user=User::find($auth->id);

        $user->devices()->updateOrCreate([
            'token' => $request->token,
            'device_type' => $request->device_type,
            'imei' => $request->imei
        ]);

        return $this->sendData([
            'user' => new UserResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 'user login successfully');

    }



    public function logout(Request $request){
        Auth::guard('api')->logout();
        return $this->sendData([], 'Successfully logged out');
    }
}
