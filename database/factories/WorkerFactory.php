<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    protected $model = Worker::class;
    public function definition(): array
    {
        return [
            'user_id' =>  User::factory(),
            'ican' => $this->faker->paragraph,
            'start_time' => $this->faker->time(),
            'finish_time' => $this->faker->time(),
        ];
    }
}
