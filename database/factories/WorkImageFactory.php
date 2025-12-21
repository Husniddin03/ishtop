<?php
// database/factories/WorkImageFactory.php
namespace Database\Factories;

use App\Models\WorkImage;
use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkImageFactory extends Factory
{
    protected $model = WorkImage::class;

    public function definition(): array
    {
        return [
            'work_id' => Work::factory(),
            'image' => fake()->imageUrl(800, 600, 'business'),
        ];
    }
}
