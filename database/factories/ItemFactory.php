<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>[
                'en' => fake()->name(),
                'ar' => fake()->name(),
            ],
            'description'=>[
                'en' =>fake()->name(),
                'ar' => fake()->name(),
            ],
            'category_id'=>Category::inRandomOrder()->first()->id
        ];
    }
}
