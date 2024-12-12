<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\ScheduleRepositoryInterface;
use App\Models\Schedule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ScheduleRepository implements ScheduleRepositoryInterface
{

    public function all(): Collection
    {
        return Schedule::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Schedule::with('training')->paginate($perPage);
    }
}
