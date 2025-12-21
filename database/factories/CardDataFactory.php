<?php

// database/factories/CardDataFactory.php
namespace Database\Factories;

use App\Models\CardData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardDataFactory extends Factory
{
    protected $model = CardData::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'number' => fake()->numberBetween(1000000000000000, 9999999999999999),
            'date' => fake()->dateTimeBetween('now', '+5 years')->format('Y-m-d'),
            'name' => fake()->name(),
            'phone' => fake()->numerify('+998#########'),
        ];
    }
}
