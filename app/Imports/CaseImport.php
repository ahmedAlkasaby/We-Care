<?php

namespace App\Imports;

use App\Models\CaseDetail;
use App\Models\CategoryCase;
use App\Models\CharityCase;
use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CaseImport implements ToModel, WithStartRow
{
    /**
     * يبدأ الاستيراد من الصف الثاني (لتخطي العناوين)
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * إنشاء النموذج لكل صف من ملف الإكسل.
     */
    public function model(array $row)
    {
        try {
            dd($row);

            $userName    = $row[41] ?? null;
            $userPhone = isset($row[14]) ? str_replace(' ', '', $row[14]) : null;
            $caseName    = $row[41] ?? null; // على افتراض أن هذا هو الاسم المستخدم للـ code_name مثلاً
            $casePrice   = $row[20] ?? 0;
            $caseDesc    = $row[6] ?? null;
            $caseCode    = $row[44] ?? null; // قد تستخدم نفس الحقل كـ code_name
            $nationalNum = isset($row[1]) ? str_replace(' ', '', $row[1]) : null;
            $condition   = $row[10] ?? null;
            $numPeople   = $row[9] ?? null;
            $area        = $row[32] ?? null;
            $street      = $row[30] ?? null;
            $district    = $row[29] ?? null;
            $building    = $row[28] ?? null;
            $floor       = $row[27] ?? null;
            $apartment   = $row[26] ?? null;

            $categoryNameValue = $row[23] ?? null;

            $regionNameValue = $row[34] ?? null;
            $cityNameValue   = $row[36] ?? null;

            // إنشاء المستخدم
            $user = User::create([
                'name'  => $userName,
                'phone' => $userPhone,
                'password' => bcrypt('ahmed145'),
                'role'=>'case'
            ]);
            $user->addRole('case');


            // إنشاء الحالة الخيرية
            $case = CharityCase::create([
                'user_id'            => $user->id,
                'name'               => ['ar' => $caseName, 'en' => $caseName],
                'repeating'          => 'monthly',
                'price'              => $casePrice,
                'done'               => 1,
                'active'             => 0,
                'description'        => ['ar' => $caseDesc, 'en' => $caseDesc],
                'next_donation_date' => Carbon::now()->addMonth()
            ]);

            // إنشاء تفاصيل الحالة
            CaseDetail::create([
                'case_id'         => $case->id,
                'code_name'       => $caseCode,
                'national_number' => $nationalNum,
                'condition'       => $condition,
                'number_of_peaple'=> $numPeople,
                'area'            => $area,
                'street'          => $street,
                'district'        => $district,
                'building'        => $building,
                'floor'           => $floor,
                'apartment'       => $apartment,
            ]);

            // معالجة الفئة (CategoryCase)
            if (!empty($categoryNameValue)) {
                $categorycase = CategoryCase::whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) = ?", [trim($categoryNameValue)])->first();
                if ($categorycase) {
                    $case->update(['category_case_id' => $categorycase->id]);
                } else {
                    // إنشاء فئة جديدة
                    $categorycase = CategoryCase::create([
                        'name'   => ['ar' => trim($categoryNameValue), 'en' => trim($categoryNameValue)],
                        'active' => 1
                    ]);
                    $case->update(['category_case_id' => $categorycase->id]);
                }
            } else {
                $case->update(['done' => 0]);
            }

            // معالجة المنطقة والمدينة
            if (!empty($regionNameValue) && !empty($cityNameValue)) {
                $region = Region::whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) = ?", [trim($regionNameValue)])->first();
                if ($region) {
                    $user->update(['region_id' => $region->id, 'city_id' => $region->city_id]);
                } else {
                    $city = City::whereRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.ar')) = ?", [trim($cityNameValue)])->first();
                    if ($city) {
                        $region = Region::create([
                            'name'   => ['ar' => trim($regionNameValue), 'en' => trim($regionNameValue)],
                            'active' => 1,
                            'city_id'=> $city->id,
                        ]);
                        $user->update(['region_id' => $region->id, 'city_id' => $city->id]);
                    } else {
                        $city = City::create([
                            'name'   => ['ar' => trim($cityNameValue), 'en' => trim($cityNameValue)],
                            'active' => 1,
                        ]);
                        $region = Region::create([
                            'name'   => ['ar' => trim($regionNameValue), 'en' => trim($regionNameValue)],
                            'active' => 1,
                            'city_id'=> $city->id,
                        ]);
                        $user->update(['region_id' => $region->id, 'city_id' => $city->id]);
                    }
                }
            } else {
                $case->update(['done' => 0]);
            }

            return $case;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
