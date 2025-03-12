<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faq>
 */
class FaqFactory extends Factory
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
                'en' => fake()->text(),
                'ar' => fake()->text(),
            ],
            'description'=>[
                'en' =>fake()->text(),
                'ar' => fake()->text(),
            ],
            'active'=>1
        ];
    }
}
