<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\MembershipRepositoryInterface;
use App\Models\Membership;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MembershipRepository implements MembershipRepositoryInterface
{
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Membership::query()->with('discount')->paginate($perPage);
    }
}
