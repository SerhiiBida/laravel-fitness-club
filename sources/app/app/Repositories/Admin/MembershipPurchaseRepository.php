<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\MembershipPurchaseRepositoryInterface;
use App\Models\MembershipPurchase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MembershipPurchaseRepository implements MembershipPurchaseRepositoryInterface
{

    public function all(): Collection
    {
        return MembershipPurchase::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return MembershipPurchase::with(['user', 'membership'])->paginate($perPage);
    }
}
