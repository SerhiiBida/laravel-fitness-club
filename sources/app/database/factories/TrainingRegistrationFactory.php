<?php

namespace Database\Factories;

use App\Enums\TrainingRegistrationStatus;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainingRegistration>
 */
class TrainingRegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(User::pluck('id')->toArray()),
            'training_id' => fake()->randomElement(Training::pluck('id')->toArray()),
            'status' => fake()->randomElement(array_column(TrainingRegistrationStatus::cases(), 'value')),
        ];
    }
}
