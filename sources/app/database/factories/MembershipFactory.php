<?php

namespace Database\Factories;

use App\Models\Bonus;
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
            'name' => fake()->title(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(20, 145),
            'image_path' => '/memberships/default/default.png',
            'validity_days' => fake()->numberBetween(7, 60),
            'bonus_id' => Bonus::factory(),
            'discount_id' => Discount::factory(),
        ];
    }
}
