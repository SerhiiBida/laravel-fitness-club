<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        return response()->json(['user' => 10000]);
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

    // Проверить авторизован ли пользователь
    public function checkAuthentication(Request $request): JsonResponse
    {
        return response()->json(['authenticated' => true]);
    }

    public function logout() {

    }
}
