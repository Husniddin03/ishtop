<?php

// database/factories/WorkerFactory.php
namespace Database\Factories;

use App\Models\Worker;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
        ];
    }
}
