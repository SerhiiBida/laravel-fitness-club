<?php

namespace App\Interfaces\Admin;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MembershipRepositoryInterface
{
    public function paginate(int $perPage): LengthAwarePaginator;
}
