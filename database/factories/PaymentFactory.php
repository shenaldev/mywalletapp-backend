<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->realText(20),
            'amount' => fake()->biasedNumberBetween(100, 5000),
            'date' => fake()->dateTimeThisMonth('now'),
            'category_id' => fake()->biasedNumberBetween(1, 6),
            'payment_method_id' => fake()->biasedNumberBetween(1, 3),
            'user_id' => 1,
        ];
    }
}
