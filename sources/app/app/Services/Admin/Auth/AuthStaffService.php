<?php

namespace App\Services\Admin\Auth;

use App\Interfaces\Admin\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthStaffService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {

    }

    public function isAuth(): bool
    {
        return Auth::check();
    }

    public function isStaff(): bool
    {
        if (Auth::check()) {
            $userId = Auth::id();

            return $this->userRepository->isStaff($userId);

        } else {
            return false;
        }
    }

    public function login(array $data): bool
    {
        return Auth::attempt($data);
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();
    }
}
