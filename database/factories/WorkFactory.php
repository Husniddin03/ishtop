<?php
// database/factories/WorkFactory.php
namespace Database\Factories;

use App\Models\Work;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkFactory extends Factory
{
    protected $model = Work::class;

    public function definition(): array
    {
        $startTime = fake()->time('H:i:s');
        $finishTime = fake()->time('H:i:s');
        
        return [
            'user_id' => User::factory(),
            'name' => fake()->jobTitle(),
            'type' => fake()->randomElement(['full-time', 'part-time', 'temporary', 'contract']),
            'price' => fake()->randomFloat(2, 50000, 500000),
            'how_much_people' => fake()->numberBetween(1, 20),
            'gender' => fake()->optional()->randomElement(['male', 'female', 'any']),
            'age' => fake()->optional()->numberBetween(18, 60),
            'lunch' => fake()->boolean(30),
            'description' => fake()->optional()->paragraph(),
            'country' => fake()->optional()->country(),
            'province' => fake()->optional()->state(),
            'region' => fake()->optional()->city(),
            'address' => fake()->optional()->address(),
            'latitude' => fake()->optional()->latitude(39, 43),
            'longitude' => fake()->optional()->longitude(56, 73),
            'when' => fake()->dateTimeBetween('now', '+3 months'),
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'duration' => fake()->numberBetween(1, 30),
        ];
    }
}
