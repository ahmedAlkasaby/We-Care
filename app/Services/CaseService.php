<?php

namespace App\Services;

use App\Http\Controllers\MainController;
use App\Models\CaseDetail;
use App\Models\CharityCase;
use App\Models\User;
use App\Traits\CaseTrait;

class CaseService extends MainController{
    use CaseTrait;



    public function caseCreateOrEdit($validatedData, $request,$type,$caseId = null){
        $cityId = $this->getCityByRegion($request->region_id);
        $data_user=[
            'name' => $request->name,
            'phone' => $request->phone ?? null,
            'role' => 'case',
            'city_id' => $cityId,
            'region_id' => $request->region_id,
            'gender' => $request->gender,
            'password' => bcrypt('password'),
            'email' => $request->email,
        ];

        $data = $request->except(['name', 'phone', 'title_en', 'title_ar', 'description_en', 'description_ar', 'region_id', 'gender','code_name','national_number','condition','type_of_aid','number_of_peaple','government','city','area','street','district','building','floor','apartment']);

        $data['name'] = [
            'en' => $request->title_en,
            'ar' => $request->title_ar,
        ];
        $data['description'] = [
            'en' => $request->description_en,
            'ar' => $request->description_ar,
        ];
        $data['next_donation_date'] = $this->calculateNextDonationDate($request->repeating);
        if ($request->price) {
            $data['price'] = $request->price;
        } else {
            $data['price'] = 0;
            $data['type']='items';
        }
        $data["end_date"]= $request->date_end;
        $data["done"]= 1;
        $data['order_no']=$request->order_no;


        $data_case_detail = [
            'code_name' => $request->code_name,
            'national_number' => $request->national_number,
            'condition' => $request->condition,
            'type_of_aid' => $request->type_of_aid,
            'number_of_peaple' => $request->number_of_peaple,
            'government' => $request->government,
            'city' => $request->city,
            'area' => $request->area,
            'street' => $request->street,
            'district' => $request->district,
            'building' => $request->building,
            'floor' => $request->floor,
            'apartment' => $request->apartment,
        ];
        if($type=="create"){
            $user = User::create($data_user);
            $data['user_id'] = $user->id;
            $user->addRole('case');
            $case = CharityCase::create($data);
            $data_case_detail['case_id'] = $case->id;
            CaseDetail::create($data_case_detail);
        }elseif($type=="update"){
            $case = CharityCase::find($caseId);
            User::where('id', $case->user_id)->update($data_user);
            $case->update($data);
            $data_case_detail['case_id'] = $case->id;
            CaseDetail::where('case_id', $case->id)->update($data_case_detail);
        }

        return $case;

    }

    public function countCasesForVolunteer($volunteer_id,$type,$case_id=null){
        $volunteer=User::find($volunteer_id);
        if($type='create'){
            $volunteer->update([
                'cases' => ($volunteer->cases) + 1
            ]);
        }elseif($type='update'){
            $case=CharityCase::find($case_id);
            if($case->volunteer_id==$volunteer_id){
            }else{
                $old_volunteer = User::find($case->volunteer_id);
                $old_volunteer->update([
                    'cases' => ($old_volunteer->cases) - 1
                ]);
                $volunteer = User::find($volunteer_id);
                $volunteer->update([
                    'cases' => ($volunteer->cases) + 1
                ]);
            }

        }

    }
}

?>
