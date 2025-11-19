<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WorkPhoto;
use App\Models\Work;

class WorkPhotoFactory extends Factory
{
    protected $model = WorkPhoto::class;

    public function definition(): array
    {
        return [
            'work_id' => Work::factory(),
            'url' => $this->faker->imageUrl(640,480,'business'),
        ];
    }
}
