<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // default password
            'role' => $this->faker->randomElement(['user','admin']),
            'phone' => $this->faker->phoneNumber,
            'image' => $this->faker->imageUrl(200,200,'people'),
        ];
    }
}
