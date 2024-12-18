<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\MembershipPurchaseRepositoryInterface;
use App\Models\MembershipPurchase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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

    public function countPerMonth(int $year, int $month): int
    {
        return MembershipPurchase::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', 'paid')
            ->count();
    }

    public function countEachPerMonthly(int $year, int $month): Collection
    {
        return MembershipPurchase::join('memberships', 'memberships.id', '=', 'membership_purchases.membership_id')
            ->select('membership_id', 'memberships.name', DB::raw('COUNT(*) as count'))
            ->whereYear('membership_purchases.created_at', $year)
            ->whereMonth('membership_purchases.created_at', $month)
            ->where('membership_purchases.status', 'paid')
            ->groupBy('membership_id')
            ->get();
    }
}
