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
            'country' => $this->faker->country(),
            'region' => $this->faker->state(),
            'district' => $this->faker->city(),
            'village' => $this->faker->citySuffix(),
            'address' => $this->faker->address(),
            'latitude' => fake()->optional()->latitude(39, 43),
            'longitude' => fake()->optional()->longitude(56, 73),
            'bio' => $this->faker->paragraph(),
        ];
    }
}
