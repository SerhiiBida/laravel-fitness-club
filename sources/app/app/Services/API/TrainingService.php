<?php

namespace App\Services\API;

use App\Models\MembershipPurchase;
use App\Models\Training;

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
