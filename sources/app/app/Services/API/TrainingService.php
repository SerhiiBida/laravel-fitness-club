<?php

namespace App\Services\API;

use App\Interfaces\TrainingRegistrationRepositoryInterface;
use App\Interfaces\TrainingRepositoryInterface;
use App\Models\MembershipPurchase;
use App\Models\Training;
use Illuminate\Support\Facades\Auth;

class TrainingService
{
    public function __construct(
        protected TrainingRegistrationRepositoryInterface $trainingRegistrationRepository,
        protected TrainingRepositoryInterface             $trainingRepository,
    )
    {

    }

    public function checkAccess(Training $training): bool
    {
        // Проверка приватности
        $isPrivate = $training->is_private;

        // Проверка регистрации на тренировку
        $userId = Auth::id();

        $checkRegister = $this->trainingRegistrationRepository->checkRegister($userId, $training->id);

        return $checkRegister || !$isPrivate;
    }

    public function show(Training $training): array
    {
        if (!$training->is_published) {
            return ['status' => 'error', 'message' => "Training is not published.", 'code' => 403];
        }

        $training->load(['user', 'memberships']);

        return ['status' => 'success', 'training' => $training];
    }

    // Проверка, имеет user ли доступ к тренировке
    public function userHasAccessToTraining(int $userId, int $trainingId): bool
    {
        $requiredMemberships = Training::getIdsRequiredMemberships($trainingId);
        $userMemberships = MembershipPurchase::getIdsMembershipsUser($userId);

        return !empty(array_intersect((array)$userMemberships, $requiredMemberships));
    }
}
