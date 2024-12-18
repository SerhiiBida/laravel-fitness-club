<?php

namespace App\Interfaces\Admin;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface MembershipPurchaseRepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;

    public function countPerMonth(int $year, int $month): int;

    public function countEachPerMonthly(int $year, int $month): Collection;
}
