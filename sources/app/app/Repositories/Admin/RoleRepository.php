<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    public function hasPermission(int $roleId, string $permission): bool
    {
        return Role::with('permissions')
            ->where('id', $roleId)
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('name', $permission);
            })->exists();
    }

    public function all(): Collection
    {
        return Role::all();
    }
}

