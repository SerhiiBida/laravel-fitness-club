<?php

namespace App\Interfaces\Admin;

interface RoleRepositoryInterface
{
    public function hasPermission(int $roleId, string $permission): bool;
}
