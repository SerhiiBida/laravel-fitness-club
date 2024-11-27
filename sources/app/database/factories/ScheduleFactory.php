<?php

namespace Database\Factories;

use App\Models\Training;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('-1 week', '+1 week');

        $endTime = $this->faker->dateTimeBetween($startTime, $startTime->format('Y-m-d H:i:s') . ' +1 hours');

        return [
            'training_id' => Training::factory(),
            'start_time' => fake()->dateTimeBetween('now', '+1 hours'),
            'end_time' => fake()->dateTimeBetween('now', '+2 hours'),
        ];
    }
}
