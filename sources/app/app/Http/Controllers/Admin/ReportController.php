<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    )
    {
        $this->middleware('permission:download global_report')->only('globalReport');
    }

    // Генерация глобального отчета
    public function globalReport()
    {
        $this->reportService->globalReport();

        return redirect()->route('admin.dashboard');
    }
}
