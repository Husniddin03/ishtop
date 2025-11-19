<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkLocation;
use App\Models\Work;

class WorkLocationFactory extends Factory
{
    protected $model = WorkLocation::class;

    public function definition(): array
    {
        return [
            'work_id' => Work::factory(),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
