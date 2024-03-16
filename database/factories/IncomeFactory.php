<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Income>
 */
class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source' => fake()->realText(20),
            'amount' => fake()->biasedNumberBetween(100, 5000),
            'date' => fake()->dateTimeThisMonth('now'),
            'user_id' => 1,
        ];
    }
}
