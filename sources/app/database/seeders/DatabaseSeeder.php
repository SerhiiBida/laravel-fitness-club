<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionRoleSeeder::class,
            UserSeeder::class,
            DiscountSeeder::class,
            MembershipSeeder::class,
            MembershipPurchaseSeeder::class,
            TrainingTypeSeeder::class,
            TrainingSeeder::class,
            TrainingRegistrationSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
