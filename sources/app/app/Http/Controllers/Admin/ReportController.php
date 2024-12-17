<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\Admin\ReportService;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    )
    {
        $this->middleware('permission:view reports|view your reports')->only('index');
        $this->middleware('permission:delete reports|delete your reports')->only('destroy');
        $this->middleware('permission:download global_report')->only('globalReport');
    }

    public function index()
    {
        $reports = $this->reportService->index();

        return view('admin.reports.index', compact('reports'));
    }

    public function destroy(Report $report)
    {
        $this->reportService->destroy($report);

        return redirect()->route('admin.reports.index');
    }

    // Генерация глобального отчета
    public function globalReport()
    {
        $this->reportService->globalReport();

        return redirect()->route('admin.dashboard');
    }
}
