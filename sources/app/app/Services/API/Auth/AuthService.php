<?php

namespace App\Services\API\Auth;

use App\Interfaces\Admin\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    )
    {

    }

    public function loginGoogle(array $data): array
    {
        try {
            // Получаем user из Google
            $googleUser = Socialite::driver('google')->with(['code' => $data['code']])->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'username' => $googleUser->getName(),
                ]
            );

            // Токен авторизации
            $token = $user->createToken('API Token')->plainTextToken;

            return ['status' => 'success', 'token' => $token];

        } catch (\Exception $error) {
            return ['status' => 'error', 'message' => 'User is invalid', 'code' => 500];
        }
    }

    public function login(array $data): array
    {
        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return ['status' => 'error', 'message' => __('auth.failed')];
        }

        // Токен авторизации
        $token = auth()->user()->createToken('API Token')->plainTextToken;

        return ['status' => 'success', 'token' => $token];
    }

    public function register(array $data): string
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Токен авторизации
        return $user->createToken('API Token')->plainTextToken;
    }
}
