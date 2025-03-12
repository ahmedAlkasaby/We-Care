<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Controllers\MainController;
use App\Models\User;

class ProfileController extends MainController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities=City::get();
        $user=auth()->user();
        return view('admin.profile.index',compact('user','cities'));
    }


    public function update(ProfileRequest $request)
    {
        $auth = auth()->user();
        $user=User::find($auth->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'lang' => $request->lang,
            'region_id' => $request->region_id,
            'city_id'=>$this->getCityByRegion($request->region_id),
        ]);
        if ($request->hasFile('img')) {
            if ($user->image==null) {
                $newImagePath = $request->file('img')->store('profile_images');

            }else{
                if ($user->image=='profile_images/defoutProfile.avif') {
                    
                }else{

                    unlink("uploads/".$user->image);
                    $newImagePath = $request->file('img')->store('profile_images');
                }
            }
        }else {
        $newImagePath = $user->image;
         }
        $user->image = $newImagePath;
        $user->save();

         session()->flash("success",__('site.Profile updated successfully'));
        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        if (!$request->has('accountActivation')) {
                session()->flash('error',__("site.You must confirm that you want to delete your account"));
                return redirect()->back();
            }

        $auth = auth()->user();
        $user=User::find($auth->id);

        $user->delete();

        session()->flash('success', __('site.Your account has been deleted'));
            return redirect()->back();
    }

    public function security(Request $request){
        $user=auth()->user();
        return view('admin.profile.includes.security', compact('user'));
    }

    public function updatePassword(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|min:8|',
        ]);

        $auth = auth()->user();
        $user=User::find($auth->id);
        if (!Hash::check($request->currentPassword, $user->password)) {

            session()->flash('error' , __('site.The current password is incorrect.'));
            return redirect()->back();

        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', __('site.Password updated successfully'));
        return redirect()->back();
}
    }

