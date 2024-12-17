<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function loginGoogle(Request $request): JsonResponse
    {
        $authorizationCode = $request->input('code');

        if (empty($authorizationCode)) {
            return response()->json(['error' => 'Error sending data to server'], 400);
        }

        try {
            // Получаем user из Google
            $googleUser = Socialite::driver('google')->with(['code' => $authorizationCode])->stateless()->user();

            // Создаём или обновляем user
            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'username' => $googleUser->getName(),
                ]
            );

            return response()->json([
                'token' => $user->createToken('API Token')->plainTextToken,
            ], 201);

        } catch (\Exception $error) {
            return response()->json(['error' => 'User is invalid'], 500);
        }
    }
}
