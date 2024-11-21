<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BonusSeeder extends Seeder
{
    // Начальные бонусы
    public function run(): void
    {
        DB::table('bonuses')->insert([
            ['amount' => 25],
            ['amount' => 50],
            ['amount' => 75],
            ['amount' => 100],
            ['amount' => 125],
            ['amount' => 150],
        ]);
    }
}
