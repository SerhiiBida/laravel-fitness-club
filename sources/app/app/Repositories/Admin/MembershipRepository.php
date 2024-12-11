<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\MembershipRepositoryInterface;
use App\Models\Membership;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MembershipRepository implements MembershipRepositoryInterface
{
    public function all(): Collection
    {
        return Membership::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Membership::with('discount')->paginate($perPage);
    }
}
