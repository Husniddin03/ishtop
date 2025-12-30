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
            'description' => $this->faker->paragraph(),
            'country' => $this->faker->country(),
            'region' => $this->faker->state(),
            'district' => $this->faker->city(),
            'village' => $this->faker->citySuffix(),
            'address' => $this->faker->address(),
            'latitude' => fake()->optional()->latitude(39, 43),
            'longitude' => fake()->optional()->longitude(56, 73),
            'when' => fake()->dateTimeBetween('now', '+3 months'),
            'start_time' => $startTime,
            'finish_time' => $finishTime,
            'duration' => fake()->numberBetween(1, 30),
            'read_count' => random_int(0, 1000),
        ];
    }
}
