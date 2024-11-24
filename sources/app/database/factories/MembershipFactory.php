<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
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
            'price' => fake()->randomFloat(2, 5, 145),
            'image_path' => '/memberships/default/default.png',
            'validity_days' => fake()->numberBetween(7, 60),
            'bonuses' => fake()->numberBetween(10, 1000),
            'is_published' => true,
            'discount_id' => Discount::factory(),
        ];
    }
}
