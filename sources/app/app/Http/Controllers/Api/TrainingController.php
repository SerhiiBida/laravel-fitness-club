<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\TrainingType;
use App\Services\API\TrainingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function __construct(
        protected TrainingService $trainingService
    )
    {

    }

    // Проверка приватности
    public function checkAccess(Training $training): JsonResponse
    {
        $isAccess = $this->trainingService->checkAccess($training);

        return response()->json([
            'is_access' => $isAccess,
        ]);
    }

    // Дать определенную тренировку
    public function show(Training $training): JsonResponse
    {
        $result = $this->trainingService->show($training);

        if ($result['status'] === 'error') {
            return response()->json(['message' => $result['message']], $result['code']);
        }

        return response()->json([
            'training' => $result['training']
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
        if ($search) {
            $trainingsQuery->where('name', 'like', '%' . $search . '%');
        }

        // Фильтрация
        if ($filter && in_array($filter, $filterOptions)) {
            $trainingsQuery->where('training_types.name', $filter);
        }

        // Сортировка
        if ($sort && in_array($sort, $sortOptions)) {
            if ($sort === 'trainer') {
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
