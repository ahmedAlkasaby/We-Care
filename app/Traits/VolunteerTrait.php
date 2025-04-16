<?php

namespace App\Traits;

use App\Http\Resources\CaseCollection;
use App\Http\Resources\CaseResource;
use App\Models\User;

trait VolunteerTrait {
    public function runningCases($volunteer_id){
        $volunteer = User::find($volunteer_id);
        $cases = $volunteer->CharityCases
            ->filter(function($case) {
                return $case->date_end > now() || is_null($case->date_end); // إضافة شرط للتحقق من أن date_end ليس null
            })
            ->filter(function($case){
                return $case->price > $case->price_raised; // شرط التصفية
            }); // استرجاع النتائج
        return CaseResource::collection($cases); // إرجاع الحالات
    }
    public function finishedCases($volunteer_id){
        $volunteer = User::find($volunteer_id);
        $cases = $volunteer->CharityCases


            ->filter(function($case){
                return $case->price <= $case->price_raised; // شرط التصفية
            }); // استرجاع النتائج
        return CaseResource::collection($cases); // إرجاع الحالات
    }
}
