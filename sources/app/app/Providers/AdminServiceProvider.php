<?php

namespace App\Providers;

use App\Interfaces\Admin\DiscountRepositoryInterface;
use App\Interfaces\Admin\MembershipPurchaseRepositoryInterface;
use App\Interfaces\Admin\MembershipRepositoryInterface;
use App\Interfaces\Admin\PermissionRepositoryInterface;
use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\Admin\ScheduleRepositoryInterface;
use App\Interfaces\Admin\TrainingRegistrationRepositoryInterface;
use App\Interfaces\Admin\TrainingRepositoryInterface;
use App\Interfaces\Admin\TrainingTypeRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface;
use App\Interfaces\ReportRepositoryInterface;
use App\Services\Admin\Auth\AuthStaffService;
use App\Services\Admin\CRUD\DiscountService;
use App\Services\Admin\CRUD\MembershipPurchaseService;
use App\Services\Admin\CRUD\MembershipService;
use App\Services\Admin\CRUD\PermissionService;
use App\Services\Admin\CRUD\RoleService;
use App\Services\Admin\CRUD\ScheduleService;
use App\Services\Admin\CRUD\TrainingRegistrationService;
use App\Services\Admin\CRUD\TrainingService;
use App\Services\Admin\CRUD\TrainingTypeService;
use App\Services\Admin\CRUD\UserService;
use App\Services\Admin\DashboardService;
use App\Services\Admin\ReportService;
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
