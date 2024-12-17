<?php

namespace App\Services\Admin;

class DashboardService
{
    public function dashboard(): array
    {
        $usersPerMonth = null;

        $trainingsPerMonth = null;

        $membershipsPerMonth = null;

        $membershipsPurchasedPerMonth = null;

        return [$usersPerMonth, $trainingsPerMonth, $membershipsPerMonth, $membershipsPurchasedPerMonth];
    }
}
