<?php

namespace App\Services\Admin;

use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;

class ReportService
{
    public function __construct(
        protected ReportRepositoryInterface $reportRepository,
        protected RoleRepositoryInterface   $roleRepository,
        protected FileService               $fileService
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

    // Генерация глобального отчета
    public function globalReport()
    {

    }
}
