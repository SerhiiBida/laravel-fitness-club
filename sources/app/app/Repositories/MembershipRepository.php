<?php

namespace App\Repositories;

use App\Interfaces\MembershipRepositoryInterface;
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

    public function countPerMonth(int $year, int $month): int
    {
        return Membership::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
    }

    public function find(int $id, bool $isOnlyPublished = false): ?Membership
    {
        return Membership::with(['discount'])
            ->addSelect(['discounted_price' => function ($query) {
                $query->selectRaw('ROUND((memberships.price - (COALESCE(memberships.price, 0) / 100) * discounts.percent), 2)')
                    ->from('discounts')
                    ->whereColumn('discounts.id', 'memberships.discount_id');
            }])
            ->when($isOnlyPublished, function ($query) {
                $query->where('is_published', 1);
            })
            ->find($id);
    }
}
