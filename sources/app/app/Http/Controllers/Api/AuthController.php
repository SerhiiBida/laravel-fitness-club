<?php

namespace App\Http\Controllers\Api;

use app\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        return response()->json(['user' => 10000]);
    }

    public function register(RegisterRequest $request): JsonResponse {
        // Валидация, автоматические ошибки
        $validated = $request->validated();

        return response()->json(['user' => 10000]);
    }

    public function logout() {

    }
}
