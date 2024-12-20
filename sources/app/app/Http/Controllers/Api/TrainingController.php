<?php

namespace App\Http\Controllers\Api;

use App\Enums\TrainingRegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingRegistration;
use App\Models\TrainingType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    // Проверка приватности
    public function checkAccess(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'trainingId' => 'required|integer|exists:trainings,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $trainingId = $request->input('trainingId');

        // Проверка приватности
        $training = Training::find($trainingId);

        $isPrivate = $training->is_private;

        // Проверка регистрации на тренировку
        $userId = Auth::id();

        $checkRegister = TrainingRegistration::where('user_id', $userId)
            ->where('training_id', $trainingId)
            ->where('status', TrainingRegistrationStatus::Active)
            ->exists();

        return response()->json([
            'is_access' => $checkRegister || !$isPrivate,
        ]);
    }

    // Дать данные
    public function show(string $id): JsonResponse
    {
        // Тренировка
        $training = Training::with('user', 'memberships')
            ->where('is_published', 1)
            ->where('id', $id)
            ->first();

        if(!$training){
            return response()->json(['message' => 'Access denied'], 403);
        }

        return response()->json([
            'training' => $training
        ]);
    }

    public function search(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'sort' => 'nullable|string',
            'filter' => 'nullable|string',
            'search' => 'nullable|string',
            'page' => 'nullable|integer|min:1',
            'perPage' => 'nullable|integer|min:1',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Incorrect data'], 400);
        }

        $sortOptions = ['name', 'trainer'];
        $filterOptions = TrainingType::pluck('name')->toArray();

        $sort = $request->input('sort');
        $filter = $request->input('filter');
        $search = $request->input('search');
        $perPage = (int)$request->input('perPage');

        // Основной запрос
        $trainingsQuery = Training::query()
            ->join('training_types', 'trainings.training_type_id', '=', 'training_types.id')
            ->join('users', 'trainings.user_id', '=', 'users.id')
            ->select('trainings.*', 'training_types.name as training_type', 'users.username as username')
            ->where('is_published', 1)
            ->where('is_private', 0);

        // Поиск
        if($search) {
            $trainingsQuery->where('name', 'like', '%' . $search . '%');
        }

        // Фильтрация
        if($filter && in_array($filter, $filterOptions)) {
            $trainingsQuery->where('training_types.name', $filter);
        }

        // Сортировка
        if($sort && in_array($sort, $sortOptions)) {
            if($sort === 'trainer') {
                $trainingsQuery->orderBy('users.username');
            } else {
                $trainingsQuery->orderBy($sort);
            }
        }

        // Количество записей на странице
        if ($perPage) {
            $trainings = $trainingsQuery->paginate($perPage);
        } else {
            $trainings = $trainingsQuery->paginate(20);
        }

        return response()->json($trainings);
    }
}
