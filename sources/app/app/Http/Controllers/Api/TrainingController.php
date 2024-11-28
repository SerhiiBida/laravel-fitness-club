<?php

namespace App\Http\Controllers\Api;

use App\Enums\TrainingType;
use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function search(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'sort' => 'nullable|string',
            'filter' => 'nullable|string',
            'search' => 'nullable|string',
            'page' => 'nullable|integer',
            'perPage' => 'nullable|integer|min:1',
        ]);

        if ($validated->fails()) {
            return response()->json(['message' => 'Incorrect data'], 400);
        }

        $sortOptions = ['name', 'trainer'];
        $filterOptions = ['individual', 'group'];

        $sort = $request->input('sort');
        $filter = $request->input('filter');
        $search = $request->input('search');
        $perPage = $request->input('perPage');

        // Основной запрос
        $trainingsQuery = Training::query()
            ->join('users', 'trainings.user_id', '=', 'users.id')
            ->select('trainings.*', 'users.username')
            ->where('is_published', 1)
            ->where('type', '!=', TrainingType::Private);

        // Поиск
        if($search) {
            $trainingsQuery->where('name', 'like', '%' . $search . '%');
        }

        // Фильтрация
        if($filter && in_array($filter, $filterOptions)) {
            $trainingsQuery->where('type', $filter);
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
