<?php

namespace App\Interfaces\Admin;

use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{
    public function all(): Collection;
}
