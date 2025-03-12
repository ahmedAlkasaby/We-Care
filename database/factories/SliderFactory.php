<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
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
            'active' => 1,
            'image'=>'slider_images/sliderDefoult.jpeg',
        ];
    }
}
