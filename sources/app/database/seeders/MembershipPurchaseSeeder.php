<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\MembershipPurchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MembershipPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $memberships = Membership::all();

        MembershipPurchase::factory()
            ->count(250)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['membership_id' => Membership::all()->random()],
                fn (Sequence $sequence) => ['user_id' => User::all()->random()],
            ))->create();
    }
}
