<?php

namespace App\Interfaces\Admin;

interface UserRepositoryInterface
{
    public function isStaff(int $id);
}
