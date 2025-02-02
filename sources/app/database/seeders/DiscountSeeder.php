<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as FakerFactory;


class DiscountSeeder extends Seeder
{
    // Начальные виды скидок
    public function run(): void
    {
        Discount::factory()->count(30)->create();
    }
}
