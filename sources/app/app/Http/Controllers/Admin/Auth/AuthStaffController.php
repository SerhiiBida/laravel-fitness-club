<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Services\Admin\Auth\AuthStaffService;

class AuthStaffController extends Controller
{
    public function __construct(
        protected AuthStaffService $authStaffService
    )
    {

    }

    // Обработка авторизованного пользователя
    public function handleAuthenticatedUser()
    {
        if ($this->authStaffService->isStaff()) {
            return redirect()->route('admin.dashboard');
        }

        abort(404);
    }

    // Форма авторизации
    public function showLogin()
    {
        if ($this->authStaffService->isAuth()) {
            return $this->handleAuthenticatedUser();
        }

        return view('admin.auth.login');
    }

    public function login()
    {

    }

    public function logout()
    {

    }
}
