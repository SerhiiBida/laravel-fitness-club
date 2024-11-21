<?php

namespace Database\Seeders;

use App\Models\Bonus;
use App\Models\Discount;
use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bonuses = Bonus::all();
        $discounts = Discount::all();

        Membership::factory()
            ->count(155)
            ->for($bonuses->random())
            ->for($discounts->random())
            ->create();
    }
}
