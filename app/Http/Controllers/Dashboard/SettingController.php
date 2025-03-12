<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class SettingController extends MainController
{

    public function edit($id){

        $setting = Setting::where('id',  $id)->first();
        return view('admin.settings.edit', compact('setting'));

    }



    public function update(SettingRequest $request, string $id){
        $setting = Setting::where('id', $id)->first();
        $setting->update([
            'site_title' => $request->site_title,
            'site_phone' => $request->site_phone,
            'site_email' => $request->site_email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
            'gmail' => $request->gmail,
            'linkedin' => $request->linkedin,

            'site_language' => $request->site_language,
            'address' => $request->address,
        ]);
       $auth=Auth::user();
       $user=User::find($auth->id);
       $user->update([
        'lang'=>$request->site_language
       ]);

        return redirect()->back()->with('success',__('site.updatingSetting'));
    }
}
