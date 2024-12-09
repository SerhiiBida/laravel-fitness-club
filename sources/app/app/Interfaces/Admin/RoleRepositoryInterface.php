<?php

namespace App\Interfaces\Admin;

use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    public function hasPermission(int $roleId, string $permission): bool;

    public function all(): Collection;
}
