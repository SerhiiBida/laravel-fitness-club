<?php

namespace App\Interfaces\Admin;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    public function hasPermission(int $roleId, string $permission): bool;

    public function getPermissionNames(int $roleId): array;

    public function all(): Collection;

    public function paginate(int $perPage): LengthAwarePaginator;

    public function find(int $roleId): array;
}
