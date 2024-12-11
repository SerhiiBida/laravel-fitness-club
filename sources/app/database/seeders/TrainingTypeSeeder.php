<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('training_types')->insert([
            ['name' => 'individual', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'group', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
