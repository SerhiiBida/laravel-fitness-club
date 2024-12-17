<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    )
    {

    }

    public function dashboard()
    {
        $statistics = $this->dashboardService->dashboard();

        return view('admin.dashboard', compact('statistics'));
    }
}
