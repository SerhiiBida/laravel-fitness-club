<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = User::where('role_id', 3)->get();

        Training::factory()
            ->count(100)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['user_id' => $admins->random()]
            ))->has(
                Membership::factory()->count(2)
            )->create();
    }
}
