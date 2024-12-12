<?php

namespace database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        // Создание тестовых тренеров
        User::factory()
            ->count(3)
            ->state([
                'role_id' => 3,
            ])->create();

        // Создание админа
        User::factory()
            ->state([
                'email' => env('ADMIN_EMAIL'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'role_id' => 1,
                'is_staff' => 1,
            ])->create();

        // Создание тренера
        User::factory()
            ->state([
                'email' => env('TRAINER_EMAIL'),
                'password' => Hash::make(env('TRAINER_PASSWORD')),
                'role_id' => 3,
                'is_staff' => 1,
            ])->create();
    }
}
