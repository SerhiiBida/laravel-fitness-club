<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|between:8,16',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => __('auth.failed')], 422);
        }

        return response()->json([
            'token'=> auth()->user()->createToken('API Token')->plainTextToken,
        ], 201);
    }

    public function register(Request $request): JsonResponse {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|between:6,18|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|between:8,16',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'token'=> $user->createToken('API Token')->plainTextToken,
        ], 201);
    }

    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }

    // Проверить авторизован ли пользователь
    public function checkAuthentication(Request $request): Response
    {
        return response()->noContent();
    }
}
