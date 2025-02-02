<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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

    public function getPermissionNames(int $roleId): array
    {
        return Role::where('id', $roleId)
            ->with('permissions')
            ->first()
            ->permissions
            ->pluck('name')
            ->toArray();
    }

    public function all(): Collection
    {
        return Role::all();
    }

    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Role::paginate($perPage);
    }

    public function find(int $roleId): Model
    {
        return Role::with('permissions')->findOrFail($roleId);
    }
}

