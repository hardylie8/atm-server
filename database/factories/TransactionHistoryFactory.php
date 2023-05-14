<?php

namespace Database\Factories;

use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'value' => fake()->numberBetween(1, 100000),
            'transaction_type' => fake()->randomElement([
                TransactionHistory::TYPE_CREDIT,
                TransactionHistory::TYPE_DEBIT,
            ]),
        ];
    }
}
