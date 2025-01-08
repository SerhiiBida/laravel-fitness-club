<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use app\Http\Requests\Admin\Auth\LoginRequest;
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

        abort(403);
    }

    // Форма авторизации
    public function showLogin()
    {
        if ($this->authStaffService->isAuth()) {
            return $this->handleAuthenticatedUser();
        }

        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if ($this->authStaffService->login($data)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'general' => 'Invalid email address or password',
        ]);
    }

    public function logout()
    {
        $this->authStaffService->logout();

        return redirect()->route('admin.show_login');
    }
}
