<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends MainController
{
    public function show(){
        $profile=Auth::guard('api')->user();

        $data=[
            'profile'=>new ProfileResource($profile)
        ];

        return $this->sendData($data);
    }

    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',

            'gender'=>'required|in:male,female',
            'region_id'=>'required|exists:regions,id',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }

        $auth=Auth::guard('api')->user();
        if($request->region_id){

            $city_id=$this->getCityByRegion($request->region_id);
        }





        $user=User::find($auth->id);

        $user->update([
            'name'=>$request->name ?? $user->name,
            'gender'=>$request->gender ?? $user->gender,
            'region_id'=>$request->region_id ?? $user->region_id,
            'address'=>$request->address ?? $user->address,
            'latitude'=>$request->latitude ?? $user->latitude,
            'longitude'=>$request->longitude ?? $user->longitude,

        ]);


        return $this->sendData(null,__('site.update_profile_successfully'));


    }


    public function changePassword(Request $request){
        $validator=Validator::make($request->all(),[
            'current_password'=>'required|min:8|string',
            'new_password'=>'required|confirmed|min:8|string'
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }

        $user=Auth::guard('api')->user();

        if(Hash::check($request->current_password, $user->password)){
            if(Hash::check($request->new_password,$user->password)){
                return $this->massageError(__('site.The old password must not match the new password'));

            }else{
                User::where('id',$user->id)->update([
                    'password'=>Hash::make($request->new_password)
                ]);

                return $this->sendData(null,__('site.change_password_successfully'));


            }
        }else{
            return $this->massageError(__('site.current_password_not_correct'));


        }

    }


    public function changeLang(Request $request){
        $validator=Validator::make($request->all(),[
            'lang'=>'required|string|in:ar,en'
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);
        }

        $user=Auth::guard('api')->user();

        User::where('id',$user->id)->update([
            'lang'=>$request->lang
        ]);

        return $this->sendData(null,__('site.change_lang_successfully'));


    }

    public function changeImage(Request $request){
        $validator=Validator::make($request->all(),[
            'image' => 'required|image|max:2048',
        ]);

        if($validator->fails()){
            return $this->sendError('error',$validator->errors(),403);

        }

        $user=Auth::guard('api')->user();

        $image=$request->file('image')->store('profile_images');

        if($user->image == 'profile_images/defoutProfile.avif'){

        }else{
            unlink('uploads/'.$user->image);
        }

        User::where('id',$user->id)->update([
            'image'=>$image
        ]);

        return $this->sendData(null,__('site.change_image'));

    }
}
