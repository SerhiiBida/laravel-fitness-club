<?php

namespace App\Services\Admin\CRUD;

use App\Repositories\Admin\PermissionRepository;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository
    )
    {

    }
}
