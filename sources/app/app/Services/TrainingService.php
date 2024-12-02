<?php

namespace App\Services;

use App\Models\Training;
use App\Models\MembershipPurchase;

class TrainingService
{
    // Проверка, имеет user ли доступ к тренировке
    public function userHasAccessToTraining(int $userId, int $trainingId): bool
    {
        $requiredMemberships = Training::getIdsRequiredMemberships($trainingId);
        $userMemberships = MembershipPurchase::getIdsMembershipsUser($userId);

        return !empty(array_intersect((array)$userMemberships, $requiredMemberships));
    }
}
