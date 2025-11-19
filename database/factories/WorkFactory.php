<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Work;

class WorkFactory extends Factory
{
    protected $model = Work::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['construction','repair','delivery']),
            'descrition' => $this->faker->paragraph,
            'date' => $this->faker->date(),
        ];
    }
}
