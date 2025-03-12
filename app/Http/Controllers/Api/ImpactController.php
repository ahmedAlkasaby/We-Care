<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImpactCollection;
use App\Http\Resources\ImpactResource;
use App\Models\Impact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImpactController extends MainController
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

        $impacts = Impact::apiFilter([
            'search' => $request->search,
            'city_id' => $request->city_id,
            'region_id' => $request->region_id,
            'price_need' => $request->price_need,
            'category_id' => $request->category_id,
            'is_urgent' => $request->is_urgent,
            'is_ending' => $request->is_ending,
            'is_event' => $request->is_event,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ])->paginate(10);

        return $this->sendData(new ImpactCollection($impacts));
    }

    public function show($id){
        $impact=Impact::with('case')->find($id);
        return $this->sendData(new ImpactResource($impact));

    }
}
