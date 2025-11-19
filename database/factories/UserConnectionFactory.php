<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserConnection;
use App\Models\User;

class UserConnectionFactory extends Factory
{
    protected $model = UserConnection::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company,
            'url' => $this->faker->url,
        ];
    }
}
