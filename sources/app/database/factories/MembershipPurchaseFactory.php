<?php

namespace Database\Factories;

use App\Enums\MembershipPurchaseStatus;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MembershipPurchase>
 */
class MembershipPurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'membership_id' => Membership::factory(),
            'user_id' => User::factory(),
            'status' => MembershipPurchaseStatus::Paid,
            'expired_at' => fake()->dateTimeBetween('now', '+2 months')
        ];
    }
}
