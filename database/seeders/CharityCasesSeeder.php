<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Region;
use App\Models\CharityCase;
use App\Models\CategoryCase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CharityCasesSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            // إنشاء المستخدم للحالة
            $user = User::create([
                'name' => fake()->name(),
                'phone' => fake()->regexify('01[0125][0-9]{8}'),
                'password' => Hash::make('ahmed145'),
                'role' => 'case',
                'region_id' => Region::inRandomOrder()->first()->id,
                'city_id' => Region::inRandomOrder()->first()->city_id,
                'password'=>Hash::make('password'),
                'email'=>fake()->email()
            ]);

            // بيانات الحالة الخيرية
            $date_start = Carbon::create(2025, 2, rand(1, 31));
            $data = [
                'user_id' => $user->id,
                'name' => [
                    'en' => fake()->text(),
                    'ar' => 'القصبي',
                ],
                'description' => [
                    'en' => fake()->text(),
                    'ar' => 'القصبي القصبيالقصبيالقصبيالقصبيالقصبيالقصبي',
                ],
                'date_start'=>$date_start,
                'date_end'=>$date_start->copy()->addDays(rand(1, 30)),
                'type'=>'items',

                'volunteer_id' => User::inRandomOrder()->where('role', 'volunteer')->first()->id,
                'category_case_id' => CategoryCase::inRandomOrder()->first()->id,
                'active' => rand(0, 1),
                'done'=>1
            ];

            // إعطاء دور للحالة
            $user->addRole('case');

            // إنشاء الحالة الخيرية
            $charityCase = CharityCase::create($data);

            // تحديث عدد الحالات المرتبطة بالمتطوع
            $volunteer = User::find($charityCase->volunteer_id);
            $volunteer->update([
                'cases' => ($volunteer->cases) + 1
            ]);

            // إرفاق العناصر إلى الحالة
            $total_price=0;
            for ($j = 0; $j < 5; $j++) {
                $item = Item::inRandomOrder()->first();
                $charityCase->items()->attach($item->id, [
                    'amount' => 5,
                    'amount_raised' => 0,
                ]);
                $total_price += $item->price * 5;


                $charityCase->images()->create(['image'=>'impact_images/impactDefoult.jpeg']);
            }
            $charityCase->update([
                'price' => $total_price,
                'price_raised' => 0,
            ]);
        }
        for ($i = 0; $i < 30; $i++) {
            // إنشاء المستخدم للحالة
            $user = User::create([
                'name' => fake()->name(),
                'phone' => fake()->regexify('01[0125][0-9]{8}'),
                'password' => Hash::make('ahmed145'),
                'role' => 'case',
                'region_id' => Region::inRandomOrder()->first()->id,
                'city_id' => Region::inRandomOrder()->first()->city_id,
                'password'=>Hash::make('password'),
                'email'=>fake()->email()
            ]);

            // بيانات الحالة الخيرية
            $date_start = Carbon::create(2025, 2, rand(1, 31));

            $data = [
                'user_id' => $user->id,
                'name' => [
                    'en' => fake()->text(),
                    'ar' => 'القصبي',
                ],
                'description' => [
                    'en' => fake()->text(),
                    'ar' => 'القصبي القصبيالقصبيالقصبيالقصبيالقصبيالقصبي',
                ],
                'date_start'=>$date_start,
                'date_end'=>$date_start->copy()->addDays(rand(1, 30)),

                'volunteer_id' => User::inRandomOrder()->where('role', 'volunteer')->first()->id,
                'category_case_id' => CategoryCase::inRandomOrder()->first()->id,
                'active' => rand(0, 1),
                'price'=>5000,
                'type'=>'price',
                'done'=>1
            ];

            // إعطاء دور للحالة
            $user->addRole('case');

            // إنشاء الحالة الخيرية
            $charityCase = CharityCase::create($data);

            // تحديث عدد الحالات المرتبطة بالمتطوع
            $volunteer = User::find($charityCase->volunteer_id);
            $volunteer->update([
                'cases' => ($volunteer->cases) + 1
            ]);

            // إرفاق العناصر إلى الحالة

        }
    }
}
