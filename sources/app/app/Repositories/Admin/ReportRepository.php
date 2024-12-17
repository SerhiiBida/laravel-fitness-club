<?php

namespace App\Repositories\Admin;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ReportRepository implements ReportRepositoryInterface
{

    public function all(): Collection
    {
        return Report::with('user')->get();
    }

    public function paginate(int $perPage, $userId = null): LengthAwarePaginator
    {
        return Report::with('user')
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage);
    }
}
