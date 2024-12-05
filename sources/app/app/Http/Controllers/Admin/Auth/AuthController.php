<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AuthController extends Controller
{
    public function showLogin(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        // Проверка, авторизации

        return view('admin.auth.login');
    }

    public function login()
    {

    }

    public function logout()
    {

    }
}
