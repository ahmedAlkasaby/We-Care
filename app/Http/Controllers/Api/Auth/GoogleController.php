<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoogleRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;



class GoogleController extends MainController
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback(GoogleRequest $request)
    {

        try {
            $userGoogle = Socialite::driver('google')->stateless()->user();
            $userGoogle=User::firstOrCreate([
                'email' => $userGoogle->getEmail(),
            ], [
                'name' => $userGoogle->getName(),
                'email' => $userGoogle->getEmail(),
                'password' => bcrypt(Str::random(10)),
                'email_verified_at' => now(),
                'role' => 'doner',
                'is_admin' => 0,
            ]);

            $userGoogle->devices()->updateOrCreate([
                'token' => $request->token,
                'device_type' => $request->device_type,
                'imei' => $request->imei
            ]);
            $token = JWTAuth::fromUser($userGoogle);


            return $this->sendData([
                'user' => new UserResource($userGoogle),
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ], 'user login successfully');




        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to authenticate with Google'], 500);
        }
    }
}
