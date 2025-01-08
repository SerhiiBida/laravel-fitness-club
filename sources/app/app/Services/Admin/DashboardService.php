<?php

namespace App\Services\Admin;

use App\Interfaces\MembershipPurchaseRepositoryInterface;
use App\Interfaces\MembershipRepositoryInterface;
use App\Interfaces\TrainingRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;

class DashboardService
{
    public function __construct(
        protected UserRepositoryInterface               $userRepository,
        protected TrainingRepositoryInterface           $trainingRepository,
        protected MembershipRepositoryInterface         $membershipRepository,
        protected MembershipPurchaseRepositoryInterface $membershipPurchaseRepository
    )
    {

    }

    public function dashboard(): array
    {
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $usersPerMonth = $this->userRepository->countPerMonth($currentYear, $currentMonth);

        $trainingsPerMonth = $this->trainingRepository->countPerMonth($currentYear, $currentMonth);

        $membershipsPerMonth = $this->membershipRepository->countPerMonth($currentYear, $currentMonth);

        $membershipsPurchasedPerMonth = $this->membershipPurchaseRepository->countPerMonth($currentYear, $currentMonth);

        return [
            'countUsers' => $usersPerMonth,
            'countTrainings' => $trainingsPerMonth,
            'countMemberships' => $membershipsPerMonth,
            'countMembershipsPurchased' => $membershipsPurchasedPerMonth
        ];
    }
}
