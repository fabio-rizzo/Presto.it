<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\announcement>
 */
class announcementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,10),
            'category_id' => rand(1,10),
            'title' => fake()->words(rand(1,7), true),
            'description' => fake()->text(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'created_at' => fake()->date(),
        ];
    }
}
