<?php

namespace Database\Seeders;

use App\Models\Training;
use App\Models\TrainingRegistration;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class TrainingRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainingRegistration::factory()
            ->count(57)
            ->create();
    }
}
