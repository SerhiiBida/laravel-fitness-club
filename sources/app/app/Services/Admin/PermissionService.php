<?php

namespace App\Services\Admin;

use App\Repositories\Admin\PermissionRepository;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository
    )
    {

    }
}