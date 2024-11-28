<?php

namespace database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        User::factory()
            ->count(3)
            ->state([
                'role_id' => 3,
            ])->create();
    }
}
