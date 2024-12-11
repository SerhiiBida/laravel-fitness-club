<?php

namespace App\Interfaces\Admin;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ScheduleRepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;
}