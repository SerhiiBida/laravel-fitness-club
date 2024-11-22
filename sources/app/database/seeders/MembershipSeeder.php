<?php

namespace Database\Seeders;

use App\Models\Bonus;
use App\Models\Discount;
use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membership::factory()
            ->count(155)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['discount_id' => Discount::all()->random()]
            ))->create();
    }
}
