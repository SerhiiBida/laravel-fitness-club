<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    public function __construct(
        protected ReportRepositoryInterface $reportRepository,
        protected RoleRepositoryInterface   $roleRepository
    )
    {

    }

    public function index()
    {
        $userId = Auth::id();

        if (!$this->roleRepository->hasPermission($userId, 'view reports')) {
            $reports = $this->reportRepository->paginate(25, $userId);

        } else {
            $reports = $this->reportRepository->paginate(25);
        }

        return $reports;
    }

    public function destroy(Report $report)
    {
        $userId = Auth::id();

        // Нужно Сделать проверку, его ли это запись? Может ли он ее удалять??
//        if (!$this->roleRepository->hasPermission($userId, 'view reports')) {
//            $reports = $this->reportRepository->paginate(25, $userId);
//
//        } else {
//            $reports = $this->reportRepository->paginate(25);
//        }
    }

    // Генерация глобального отчета
    public function globalReport()
    {

    }
}
