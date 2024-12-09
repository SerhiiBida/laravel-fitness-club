<?php

namespace App\Interfaces\Admin;

interface UserRepositoryInterface
{
    public function isStaff(int $id);

    public function all();

    public function paginate(int $perPage);
}
