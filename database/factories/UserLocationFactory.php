<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserLocation;
use App\Models\User;

class UserLocationFactory extends Factory
{
    protected $model = UserLocation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
