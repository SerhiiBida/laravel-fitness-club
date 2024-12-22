<?php

namespace App\Interfaces;

use App\Models\Membership;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface MembershipRepositoryInterface
{
    public function all(): Collection;

    public function countPerMonth(int $year, int $month): int;

    public function find(int $id, bool $isOnlyPublished): ?Membership;

    public function paginate(int $perPage, ?string $search = null, ?int $filter = null, ?string $sort = null, bool $isOnlyPublished = false): LengthAwarePaginator;
}
