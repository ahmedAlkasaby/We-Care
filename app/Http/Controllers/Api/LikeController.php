<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseCollection;
use App\Http\Resources\CaseResource;
use App\Models\CharityCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends MainController
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_urgent' => 'nullable|in:1,0',
            'is_ending' => 'nullable|in:1,0',
            'is_event' => 'nullable|in:1,0',
            'category_id' => 'nullable|exists:category_cases,id',
            'price_need' => 'nullable|numeric',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'search' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError('error', $validator->errors(), 403);
        }

        $auth = Auth::guard('api')->user();
        $user = User::find($auth->id);


        $filters = [
            'search' => $request->search,
            'city_id' => $request->city_id,
            'region_id' => $request->region_id,
            'min_price_need' => $request->min_price_need,
            'max_price_need' => $request->max_price_need,
            'category_id' => $request->category_id,
            'is_urgent' => $request->is_urgent,
            'is_ending' => $request->is_ending,
            'is_event' => $request->is_event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'order_by' => $request->order_by
        ];

        $likeCases = CharityCase::with('users','items','images','volunteer','category','donations','transfers')->whereHas('users', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->apiFilter($filters)->paginate(10);


        return $this->sendData(new CaseCollection($likeCases));
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'case_id'=>'required|exists:charity_cases,id',
            'is_like'=>'required|in:yes,no',
        ]);

        if($validator->fails()){
           return $this->sendError('error',$validator->errors(),403);

        }

        $auth=Auth::guard('api')->user();
        $user=User::find($auth->id);
        if($request->is_like == 'yes'){
            if($user->likeCases()->where('case_id', $request->case_id)->exists()){
                return $this->massageError(__('site.the_case_already_in_likes'),403);
            }
            $user->likeCases()->attach($request->case_id);
         return $this->sendData(null,__('site.create_case_in_likes'));

        }else{
            if ($user->likeCases()->where('case_id', $request->case_id)->exists()) {
                $user->likeCases()->detach($request->case_id);
               return $this->sendData(null,__('site.remove_case_from_likes'));
            } else {
               return $this->massageError(__('site.the_case_not_found_in_likes'),404);
            }
        }



    }

    public function destroy($case_id){
        $auth=Auth::guard('api')->user();
        $user=User::find($auth->id);
        if ($user->likeCases()->where('case_id', $case_id)->exists()) {
            $user->likeCases()->detach($case_id);

           return $this->sendData([],__('site.remove_case_from_likes'));
        } else {
           return $this->massageError(__('site.the_case_not_found_in_likes'),404);
        }
    }
}
