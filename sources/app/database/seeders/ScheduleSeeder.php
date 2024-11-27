<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\Training;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::factory()
            ->count(300)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['training_id' => Training::all()->random()]
            ))
            ->create()
            ->each(function ($schedule) {
                $users = User::all()->random(2);

                // Многие ко многим, связи на основе уже существующих записей
                $schedule->users()->attach($users->pluck('id'));
            });
    }
}
