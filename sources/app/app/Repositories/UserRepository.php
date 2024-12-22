<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function isStaff(int $id): bool
    {
        $user = User::find($id);

        return $user && $user->is_staff;
    }

    public function all(): Collection
    {
        return User::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    public function countPerMonth(int $year, int $month): int
    {
        return User::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
    }
}
