<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginAuthRequest;
use App\Http\Requests\Api\Auth\RegisterAuthRequest;
use App\Services\API\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    )
    {

    }

    public function login(LoginAuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        $result = $this->authService->login($data);

        if ($result['status'] === 'error') {
            return response()->json(['message' => $result['message']], 422);
        }

        return response()->json(['token' => $result['token']], 201);
    }

    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        $token = $this->authService->register($data);

        return response()->json(['token' => $token], 201);
    }

    public function logout(Request $request): Response
    {
        // Удаление токена авторизации
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }

    // Авторизован ли пользователь
    public function checkAuthentication(Request $request): Response
    {
        return response()->noContent();
    }
}
