<?php

namespace Database\Seeders;

use App\Models\CharityCase;
use App\Models\Impact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpactSeeder extends Seeder
{

    public function run(): void
    {
        for ($i=0; $i < 5; $i++) {
            $Impact=Impact::create([
                'name'=>[
                    'en' => fake()->name(),
                    'ar' => fake()->name(),
                ],
                'case_id'=>CharityCase::inRandomOrder()->first()->id,

                'description'=>[
                    'en' =>fake()->name(),
                    'ar' => fake()->name(),
                ],
            ]);
            $Impact->images()->create(['image'=>'impact_images/impactDefoult.jpeg']);
        }
    }
}
