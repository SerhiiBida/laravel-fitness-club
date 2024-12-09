<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function isStaff(int $id)
    {
        return User::find($id)->is_staff;
    }

    public function all(): Collection
    {
        return User::all();
    }


    public function paginate(int $perPage)
    {
        return User::query()->paginate($perPage);
    }
}
