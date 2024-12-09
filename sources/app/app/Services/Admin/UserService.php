<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\UserRepositoryInterface;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {

    }
}
