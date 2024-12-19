<?php

namespace App\Services\API\Auth;

use App\Interfaces\Admin\UserRepositoryInterface;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    )
    {
    }
}
