<?php

namespace App\Http\Controllers\Api;

use App\Models\CharityCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CaseCollection;
use App\Http\Resources\CaseResource;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Debugbar;

class CaseController extends MainController
{
    public function index(Request $request) {

        $validator = Validator::make($request->all(), [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_urgent' => 'nullable|in:1,0',
            'is_ending' => 'nullable|in:1,0',
            'is_event' => 'nullable|in:1,0',
            'category_id' => 'nullable|exists:category_cases,id',
            'min_price_need' => 'nullable|numeric',
            'max_price_need' => 'nullable|numeric',
            'region_id' => 'nullable|exists:regions,id',
            'city_id' => 'nullable|exists:cities,id',
            'search' => 'nullable|string',
            'order_by'=>'nullable|in:desc,asc'
        ]);

        if ($validator->fails()) {
           return $this->sendError('error',$validator->errors(),403);

        }



        $cases = CharityCase::with('users','items','images','volunteer','category','donations','transfers')->apiFilter([
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
        ])->paginate(10);

       



        return $this->sendData(new CaseCollection($cases));
    }


    public function show($id){
        $case=CharityCase::with('donations')->find($id);
        if($case){
            $data=new CaseResource($case);
            return $this->sendData($data);
        }else{
            return $this->sendError('the Case not found');
        }
    }


}
