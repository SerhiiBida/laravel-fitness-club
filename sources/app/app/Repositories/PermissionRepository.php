<?php

namespace App\Repositories;


use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;
use Illuminate\Support\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all(): Collection
    {
        return Permission::all();
    }
}
