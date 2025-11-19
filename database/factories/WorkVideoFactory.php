<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkVideo;
use App\Models\Work;

class WorkVideoFactory extends Factory
{
    protected $model = WorkVideo::class;

    public function definition(): array
    {
        return [
            'work_id' => Work::factory(),
            'url' => $this->faker->url . '/video.mp4',
        ];
    }
}
