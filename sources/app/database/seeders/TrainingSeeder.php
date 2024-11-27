<?php

namespace Database\Seeders;

use App\Models\Membership;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()
            ->state([
                'role_id' => 3,
            ])->create();

        Training::factory()
            ->count(100)
            ->state(
                ['user_id' => $user->id]
            )->has(
                Membership::factory()->count(2)
            )->create();
    }
}
