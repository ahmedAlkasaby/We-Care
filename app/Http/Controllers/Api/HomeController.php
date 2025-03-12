<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaseCollection;
use App\Http\Resources\CaseResource;
use App\Http\Resources\CategoryCaseResource;
use App\Http\Resources\CityRecource;
use App\Http\Resources\ImpactResource;
use App\Http\Resources\SliderResource;
use App\Models\CategoryCase;
use App\Models\CharityCase;
use App\Models\City;
use App\Models\Impact;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends MainController
{
    public function home(){
        $now=Carbon::now();
        $nextWeek=Carbon::now()->addWeek();
        $the_cases_coming_to_end=CharityCase::where('active',1)->whereBetween('date_end',[$now,$nextWeek])->paginate(10);
        $urgent_cases=CharityCase::where('active',1)->where('priority','high')->paginate(10);
        $events=CharityCase::where('active',1)->where('is_event',1)->paginate(10);
        $sliders=Slider::where('active',1)->paginate(10);
        $impacts=Impact::paginate(10);

        $data=[
            'sliders'=>SliderResource::collection($sliders),
            'urgent_cases'=>CaseResource::collection($urgent_cases),
            'events'=>CaseResource::collection($events),
            'impacts'=>ImpactResource::collection($impacts),
            'the_cases_coming_to_end'=>CaseResource::collection($the_cases_coming_to_end),
        ];


        return $this->sendData($data);
    }




    public function locations(){
        $cities=City::with('regions')->get();
        $data=[
            'locations'=>CityRecource::collection($cities)
        ];

        return $this->sendData($data);

    }

    public function filter(Request $request) {
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
           return $this->sendError('error',$validator->errors(),403);

        }

        $cases = CharityCase::apiFilter([
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

        return $this->sendData(new CaseCollection($cases));
    }


}
