<?php

namespace App\Http\Controllers\Api;

use App\Enums\TrainingRegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\TrainingRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingRegistrationController extends Controller
{
    // Проверка, зарегистрирован ли на тренировку
    public function check(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'userId' => 'required|integer|exists:users,id',
            'trainingId' => 'required|integer|exists:trainings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = $request->input('userId');
        $trainingId = $request->input('trainingId');

        // Зарегистрирован ли
        $check = TrainingRegistration::where('user_id', $userId)
            ->where('training_id', $trainingId)
            ->where('status', TrainingRegistrationStatus::Active)
            ->exists();

        return response()->json([
            'is_registered' => $check,
        ]);
    }
}
