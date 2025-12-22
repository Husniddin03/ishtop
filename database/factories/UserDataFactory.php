<?php

// database/factories/UserDataFactory.php
namespace Database\Factories;

use App\Models\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDataFactory extends Factory
{
    protected $model = UserData::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->optional()->randomElement(['male', 'female']),
            'height' => fake()->optional()->randomFloat(2, 150, 200),
            'weight' => fake()->optional()->randomFloat(2, 50, 120),
            'birthday' => fake()->optional()->dateTimeBetween('-60 years', '-18 years'),
            'country' => fake()->optional()->country(),
            'province' => fake()->optional()->state(),
            'region' => fake()->optional()->city(),
            'address' => fake()->optional()->address(),
            'latitude' => fake()->optional()->latitude(39, 43),
            'longitude' => fake()->optional()->longitude(56, 73),
            'bio' => fake()->optional()->paragraph(),
        ];
    }
}
