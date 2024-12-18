<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\MembershipPurchaseRepositoryInterface;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;
use App\Services\FileService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    public function __construct(
        protected ReportRepositoryInterface             $reportRepository,
        protected RoleRepositoryInterface               $roleRepository,
        protected FileService                           $fileService,
        protected DashboardService                      $dashboardService,
        protected MembershipPurchaseRepositoryInterface $membershipPurchaseRepository
    )
    {

    }

    public function index()
    {
        $user = Auth::user();

        $userId = $user->id;
        $roleId = $user->role_id;

        if (!$this->roleRepository->hasPermission($roleId, 'view reports')) {
            $reports = $this->reportRepository->paginate(25, $userId);

        } else {
            $reports = $this->reportRepository->paginate(25);
        }

        return $reports;
    }

    public function destroy(Report $report): void
    {
        $user = Auth::user();

        $userId = $user->id;
        $roleId = $user->role_id;

        // Пользователь пытается удалить не свой отчет
        if ($report->user_id !== $userId && !$this->roleRepository->hasPermission($roleId, 'delete reports')) {
            return;
        }

        $this->fileService->delete($report->file_path);

        $report->delete();
    }

    // Данные глобального отчета
    public function getDataGlobalReport(): array
    {
        // Общая статистика
        $generalStatistics = $this->dashboardService->dashboard();

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Количество раз сколько купили каждый абонемент за месяц
        $statisticEachMembership = $this->membershipPurchaseRepository->countEachPerMonthly($currentYear, $currentMonth);

        return [...$generalStatistics, 'statisticEachMembership' => $statisticEachMembership];
    }

    // Создание файла отчета
    public function generateReport(string $view, array $data, string $nameReport, int $userId): bool
    {
        $pdf = Pdf::loadView($view, compact('data'));

        list($fullPath, $path) = $this->fileService->generateUniquePath('reports', 'pdf', 'report');

        $pdf->save($fullPath);

        // Сохраняем в БД
        if ($this->fileService->hasFile($path)) {
            Report::create([
                'user_id' => $userId,
                'name' => $nameReport,
                'file_path' => $path
            ]);

            return true;
        }

        return false;
    }
}
