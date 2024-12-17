<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
}
