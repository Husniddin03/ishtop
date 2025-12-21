<?php

// database/factories/UserContactFactory.php
namespace Database\Factories;

use App\Models\UserContact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserContactFactory extends Factory
{
    protected $model = UserContact::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'phone' => fake()->optional()->numerify('+998#########'),
            'telegram' => fake()->optional()->userName(),
            'facebook' => fake()->optional()->url(),
            'instagram' => fake()->optional()->userName(),
        ];
    }
}
