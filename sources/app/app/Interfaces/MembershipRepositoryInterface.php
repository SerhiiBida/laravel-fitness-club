<?php

namespace App\Interfaces;

use App\Models\Membership;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface MembershipRepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;

    public function countPerMonth(int $year, int $month): int;

    public function find(int $id, bool $isOnlyPublished): ?Membership;
}
