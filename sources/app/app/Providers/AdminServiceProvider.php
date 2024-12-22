<?php

namespace App\Providers;

use App\Interfaces\DiscountRepositoryInterface;
use App\Interfaces\MembershipPurchaseRepositoryInterface;
use App\Interfaces\MembershipRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\ScheduleRepositoryInterface;
use App\Interfaces\TrainingRegistrationRepositoryInterface;
use App\Interfaces\TrainingRepositoryInterface;
use App\Interfaces\TrainingTypeRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Services\Admin\Auth\AuthStaffService;
use App\Services\Admin\DashboardService;
use App\Services\Admin\DiscountService;
use App\Services\Admin\MembershipPurchaseService;
use App\Services\Admin\MembershipService;
use App\Services\Admin\PermissionService;
use App\Services\Admin\ReportService;
use App\Services\Admin\RoleService;
use App\Services\Admin\ScheduleService;
use App\Services\Admin\TrainingRegistrationService;
use App\Services\Admin\TrainingService;
use App\Services\Admin\TrainingTypeService;
use App\Services\Admin\UserService;
use App\Services\FileService;
use App\Services\MailService;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Services
        $this->app->bind(AuthStaffService::class, function ($app) {
            return new AuthStaffService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                $app->make(UserRepositoryInterface::class),
                $app->make(RoleRepositoryInterface::class),
                $app->make(FileService::class),
            );
        });

        $this->app->bind(RoleService::class, function ($app) {
            return new RoleService(
                $app->make(RoleRepositoryInterface::class),
                $app->make(PermissionRepositoryInterface::class)
            );
        });

        $this->app->bind(PermissionService::class, function ($app) {
            return new PermissionService($app->make(PermissionRepositoryInterface::class));
        });

        $this->app->bind(DiscountService::class, function ($app) {
            return new DiscountService($app->make(DiscountRepositoryInterface::class));
        });

        $this->app->bind(MembershipService::class, function ($app) {
            return new MembershipService(
                $app->make(MembershipRepositoryInterface::class),
                $app->make(DiscountRepositoryInterface::class),
                $app->make(FileService::class),
            );
        });

        $this->app->bind(MembershipPurchaseService::class, function ($app) {
            return new MembershipPurchaseService(
                $app->make(MembershipPurchaseRepositoryInterface::class),
                $app->make(MembershipRepositoryInterface::class),
                $app->make(UserRepositoryInterface::class),
            );
        });

        $this->app->bind(TrainingTypeService::class, function ($app) {
            return new TrainingTypeService($app->make(TrainingTypeRepositoryInterface::class));
        });

        $this->app->bind(TrainingService::class, function ($app) {
            return new TrainingService(
                $app->make(TrainingRepositoryInterface::class),
                $app->make(TrainingTypeRepositoryInterface::class),
                $app->make(UserRepositoryInterface::class),
                $app->make(MembershipRepositoryInterface::class),
                $app->make(TrainingRegistrationRepositoryInterface::class),
                $app->make(FileService::class),
            );
        });

        $this->app->bind(TrainingRegistrationService::class, function ($app) {
            return new TrainingRegistrationService(
                $app->make(TrainingRegistrationRepositoryInterface::class),
                $app->make(UserRepositoryInterface::class),
                $app->make(TrainingRepositoryInterface::class)
            );
        });

        $this->app->bind(FileService::class, function ($app) {
            return new FileService();
        });

        $this->app->bind(MailService::class, function ($app) {
            return new MailService();
        });

        $this->app->bind(ScheduleService::class, function ($app) {
            return new ScheduleService(
                $app->make(ScheduleRepositoryInterface::class),
                $app->make(TrainingRepositoryInterface::class),
                $app->make(UserRepositoryInterface::class),
                $app->make(TrainingRegistrationRepositoryInterface::class),
                $app->make(MailService::class)
            );
        });

        $this->app->bind(DashboardService::class, function ($app) {
            return new DashboardService(
                $app->make(UserRepositoryInterface::class),
                $app->make(TrainingRepositoryInterface::class),
                $app->make(MembershipRepositoryInterface::class),
                $app->make(MembershipPurchaseRepositoryInterface::class),
            );
        });

        $this->app->bind(ReportService::class, function ($app) {
            return new ReportService(
                $app->make(ReportRepositoryInterface::class),
                $app->make(RoleRepositoryInterface::class),
                $app->make(FileService::class),
                $app->make(DashboardService::class),
                $app->make(MembershipPurchaseRepositoryInterface::class),
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
