<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\TypeStorage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            $item=Item::create([
                'name'=>[
                    'en' => fake()->name(),
                    'ar' => fake()->name(),
                ],
                'description'=>[
                    'en' => fake()->name(),
                    'ar' => fake()->name(),
                ],
                'price'=>50,
                'amount'=>100,
                'category_id'=>Category::inRandomOrder()->first()->id
            ]);
        }
    }
}
