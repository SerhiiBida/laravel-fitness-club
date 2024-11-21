<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    // Начальные виды скидок
    public function run(): void
    {
        DB::table('discounts')->insert([
            ['percent' => 5],
            ['percent' => 10],
            ['percent' => 15],
            ['percent' => 20],
            ['percent' => 25],
            ['percent' => 30]
        ]);
    }
}
