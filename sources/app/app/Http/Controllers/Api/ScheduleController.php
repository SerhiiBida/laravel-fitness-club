<?php

namespace App\Http\Controllers\Api;

use App\Enums\TrainingRegistrationStatus;
use App\Http\Controllers\Controller;
use App\Models\MembershipPurchase;
use App\Models\Schedule;
use App\Models\Training;
use App\Models\TrainingRegistration;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
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

        // Истек абонемент у user
        $requiredMemberships = Training::getIdsRequiredMemberships($trainingId);
        $userMemberships = MembershipPurchase::getIdsMembershipsUser($userId);

        if(!array_intersect($userMemberships, $requiredMemberships)){
            return response()->json(['message' => 'Buy one of the required memberships'], 403);
        }

        // Проверка, зарегистрирован ли пользователь на тренировку
        $checkRegister = TrainingRegistration::where('user_id', $userId)
            ->where('training_id', $trainingId)
            ->where('status', TrainingRegistrationStatus::Active)
            ->exists();

        if(!$checkRegister) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        // Основной запрос для расписания и посещения пользователя
        $schedulesQuery = Schedule::with(['users' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->where('training_id', $trainingId)
            ->orderBy('start_time');

        // Элементов на странице
        if(!$perPage) {
            $perPage = 3;
        }

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

//    // Отмечает, посещение пользователя
//    public function createVisitUser(): JsonResponse
//    {
//        $validator = Validator::make(request()->all(), [
//            'scheduleId' => 'required|integer|exists:schedules,id',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['message' => 'Incorrect data format'], 422);
//        }
//
//        $scheduleId = request()->input('scheduleId');
//
//
//    }
//
//    // Удаляет, посещение пользователя
//    public function destroyVisitUser(): JsonResponse
//    {
//
//    }
}
