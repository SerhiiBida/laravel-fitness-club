<?php

namespace app\Http\Controllers\API;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return response()->json(['user' => 10000]);
    }

    public function register() {

    }

    public function logout() {

    }
}
