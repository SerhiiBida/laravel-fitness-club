<?php

namespace App\Repositories\Admin;


use App\Interfaces\Admin\PermissionRepositoryInterface;
use App\Models\Permission;
use Illuminate\Support\Collection;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function all(): Collection
    {
        return Permission::all();
    }
}
