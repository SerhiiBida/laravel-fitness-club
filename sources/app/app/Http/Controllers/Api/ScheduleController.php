<?php

namespace App\Http\Controllers\Api;

use App\Enums\TrainingRegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\MembershipPurchase;
use App\Models\Schedule;
use App\Models\Training;
use App\Models\TrainingRegistration;
use App\Services\TrainingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    protected TrainingService $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
    }

    public function listByUser(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'trainingId' => 'required|integer|exists:trainings,id',
            'perPage' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $trainingId = request()->input('trainingId');
        $perPage = request()->input('perPage');
        $page = request()->input('page');

        $userId = Auth::id();

        // Нету нужного абонемента у user
        if(!$this->trainingService->userHasAccessToTraining($userId, $trainingId)) {
            return response()->json(['message' => 'Buy one of the required memberships'], 403);
        }

        // User не зарегистрирован на тренировку
        if(!TrainingRegistration::checkRegistration($userId, $trainingId)) {
            return response()->json(['message' => 'You need to register for training'], 403);
        }

        // Основной запрос для расписания и посещения пользователя
        $schedulesQuery = Schedule::with(['users' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('training_id', $trainingId)
            ->orderBy('start_time');

        // Элементов на странице
        $perPage = $perPage ?? 3;

        // Начинаем пагинацию со страницы, где ближайшее расписание
        if(!$page){
            $currentDate = date('Y-m-d H:i:s');

            $nearestSchedule = Schedule::where('training_id', $trainingId)
                ->where('start_time', '>=', $currentDate)
                ->orderBy('start_time')
                ->first();

            if($nearestSchedule){
                // Страница с ближайшим расписанием
                $position = Schedule::where('training_id', $trainingId)
                    ->where('start_time', '<', $nearestSchedule->start_time)
                    ->orderBy('start_time')
                    ->count();

                $position += 1;

            } else {
                // Последняя страница
                $position = Schedule::where('training_id', $trainingId)->count();
            }

            $page = ceil($position / $perPage);
        }

        // Пагинация
        $schedules = $schedulesQuery->paginate($perPage, ['*'], 'page', $page);

        return response()->json($schedules);
    }

    // Отмечает, посещение пользователя
    public function createVisitUser(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'scheduleId' => 'required|integer|exists:schedules,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $scheduleId = request()->input('scheduleId');
        $userId = Auth::id();

        $schedule = Schedule::find($scheduleId);

        $trainingId = $schedule->training_id;

        // Нету нужного абонемента у user
        if(!$this->trainingService->userHasAccessToTraining($userId, $trainingId)) {
            return response()->json(['message' => 'Buy one of the required memberships'], 403);
        }

        // User не зарегистрирован на тренировку
        if(!TrainingRegistration::checkRegistration($userId, $trainingId)) {
            return response()->json(['message' => 'You need to register for training'], 403);
        }

        // Отмечаем визит
        $schedule->users()->attach($userId);

        return response()->json(['message' => 'Created'], 201);
    }

    // Удаляет, посещение пользователя
    public function destroyVisitUser(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'scheduleId' => 'required|integer|exists:schedules,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Incorrect data format'], 422);
        }

        $scheduleId = request()->input('scheduleId');
        $userId = Auth::id();

        $schedule = Schedule::find($scheduleId);

        $trainingId = $schedule->training_id;

        // Нету нужного абонемента у user
        if(!$this->trainingService->userHasAccessToTraining($userId, $trainingId)) {
            return response()->json(['message' => 'Buy one of the required memberships'], 403);
        }

        // User не зарегистрирован на тренировку
        if(!TrainingRegistration::checkRegistration($userId, $trainingId)) {
            return response()->json(['message' => 'You need to register for training'], 403);
        }

        // Удаляем визит
        $schedule->users()->detach($userId);

        return response()->json(['message' => 'Deleted'], 204);
    }
}
