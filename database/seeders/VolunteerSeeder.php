<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            $volunteer=User::create([
                'name'=>fake()->name(),
                'phone'=>fake()->regexify('01[0125][0-9]{8}'),
                'email'=>fake()->email(),
                'gender'=>'male',

                'password'=>Hash::make('ahmed145'),
                'role'=>'volunteer',
                'city_id'=>City::inRandomOrder()->first()->id,
                'region_id'=>Region::where('city_id',City::inRandomOrder()->first()->id)->inRandomOrder()->first()->id,

            ]);

            $volunteer->addRole('volunteer');
        }
    }
}
