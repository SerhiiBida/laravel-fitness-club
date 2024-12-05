<?php

namespace App\Http\Controllers\Api;

use App\Enums\TrainingRegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingRegistration;
use app\Services\API\TrainingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrainingRegistrationController extends Controller
{
    protected TrainingService $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    // Список активных тренировок пользователя
    public function listByUser(Request $request): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'perPage' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = Auth::id();
        $perPage = request()->input('perPage');

        $trainingsQuery = TrainingRegistration::with('training')
            ->where('user_id', $userId)
            ->where('status', TrainingRegistrationStatus::Active)
            ->whereHas('training', function ($query) use ($request) {
                $query->where('is_published', 1);
            });

        // Продуктов на странице
        $perPage = $perPage ?? 8;

        // Пагинация
        $trainings = $trainingsQuery->paginate($perPage);

        return response()->json($trainings);
    }

    // Регистрация на тренировку
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'trainingId' => 'required|integer|exists:trainings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = Auth::id();
        $trainingId = (int)$request->input('trainingId');

        // Пользователь уже зарегистрировался
        $checkTrainingRegistration = TrainingRegistration::where('training_id', $trainingId)
            ->where('user_id', $userId)
            ->where('status', TrainingRegistrationStatus::Active)
            ->exists();

        if($checkTrainingRegistration) {
            return response()->json(['message' => 'You are already registered'], 422);
        }

        // У user нет нужного абонемента
        if(!$this->trainingService->userHasAccessToTraining($userId, $trainingId)) {
            return response()->json(['message' => 'Buy one of the required memberships'], 422);
        }

        $training = Training::where('id', $trainingId)->first();

        // Не опубликована
        if(!$training->is_published){
            return response()->json(['message' => 'You are denied access'], 403);
        }

        // На приватную тренировку нельзя зарегистрироваться(только тренер регистрирует)
        if($training->is_private) {
            return response()->json(['message' => 'You are denied access'], 403);
        }

        // Регистрируем
        TrainingRegistration::updateOrCreate([
            'user_id' => $userId,
            'training_id' => $trainingId,
        ], [
            'status' => TrainingRegistrationStatus::Active,
        ]);

        return response()->json(['message' => 'Success']);
    }

    // Отписываем пользователя
    public function deactivate(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'trainingId' => 'required|integer|exists:trainings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = Auth::id();
        $trainingId = $request->input('trainingId');

        TrainingRegistration::updateOrCreate([
            'user_id' => $userId,
            'training_id' => $trainingId,
        ], [
            'status' => TrainingRegistrationStatus::Inactive,
        ]);

        return response()->json(['message' => 'Success']);
    }

    // Проверка, зарегистрирован ли на тренировку
    public function check(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'trainingId' => 'required|integer|exists:trainings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $userId = Auth::id();
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
