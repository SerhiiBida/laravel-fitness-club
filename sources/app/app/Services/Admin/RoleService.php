<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;

class RoleService
{
    public function __construct(
        protected RoleRepositoryInterface $roleRepository
    )
    {

    }
}
