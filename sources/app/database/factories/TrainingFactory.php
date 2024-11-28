<?php

namespace Database\Factories;

use App\Enums\TrainingType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(30),
            'description' => fake()->paragraph(10),
            'image_path' => '/trainings/default/default.png',
            'type' => fake()->randomElement(array_column(TrainingType::cases(), 'value')),
            'user_id' => User::factory(),
            'is_published' => fake()->boolean
        ];
    }
}
