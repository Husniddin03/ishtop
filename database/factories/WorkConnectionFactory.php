<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkConnection;
use App\Models\Work;

class WorkConnectionFactory extends Factory
{
    protected $model = WorkConnection::class;

    public function definition(): array
    {
        return [
            'work_id' => Work::factory(),
            'name' => $this->faker->company,
            'url' => $this->faker->url,
        ];
    }
}
