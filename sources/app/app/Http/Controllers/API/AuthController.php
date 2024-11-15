<?php

namespace app\Http\Controllers\API;

use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(): JsonResponse
    {
        return response()->json(['user' => 10000]);
    }

    public function register() {

    }

    public function logout() {

    }
}
