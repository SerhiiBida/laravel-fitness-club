<?php

namespace App\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function isStaff(int $id): bool;

    public function all(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;

    public function countPerMonth(int $year, int $month): int;
}
