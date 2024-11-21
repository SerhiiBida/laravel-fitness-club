<?php

namespace Database\Seeders;

use App\Models\Bonus;
use App\Models\Discount;
use App\Models\Membership;
use App\Models\MembershipPurchase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ->for($users->random())
            ->for($memberships->random())
            ->create();
    }
}
