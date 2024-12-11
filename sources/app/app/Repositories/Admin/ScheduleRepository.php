<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\ScheduleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ScheduleRepository implements ScheduleRepositoryInterface
{

    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement paginate() method.
    }
}
