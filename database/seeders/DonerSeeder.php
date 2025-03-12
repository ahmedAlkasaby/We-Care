<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            $doner=User::create([
                'name'=>fake()->name(),
                'email'=>fake()->email(),
                'phone'=>fake()->regexify('01[0125][0-9]{8}'),
                'password'=>Hash::make('ahmed145'),
                'role'=>'doner',
                'gender'=>'male',
                'city_id'=>City::inRandomOrder()->first()->id,
                'region_id'=>Region::where('city_id',City::inRandomOrder()->first()->id)->inRandomOrder()->first()->id,
                'lang'=>'en',
                'password'=>Hash::make('ahmed145')
            ]);

            $doner->addRole('doner');
        }
    }
}
