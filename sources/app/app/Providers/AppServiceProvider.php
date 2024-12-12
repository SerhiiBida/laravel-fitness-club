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
use App\Repositories\Admin\DiscountRepository;
use App\Repositories\Admin\MembershipPurchaseRepository;
use App\Repositories\Admin\MembershipRepository;
use App\Repositories\Admin\PermissionRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\ScheduleRepository;
use App\Repositories\Admin\TrainingRegistrationRepository;
use App\Repositories\Admin\TrainingRepository;
use App\Repositories\Admin\TrainingTypeRepository;
use App\Repositories\Admin\UserRepository;
use App\Services\Admin\Auth\AuthStaffService;
use App\Services\Admin\DiscountService;
use App\Services\Admin\MembershipPurchaseService;
use App\Services\Admin\MembershipService;
use App\Services\Admin\PermissionService;
use App\Services\Admin\RoleService;
use App\Services\Admin\ScheduleService;
use App\Services\Admin\TrainingRegistrationService;
use App\Services\Admin\TrainingService;
use App\Services\Admin\TrainingTypeService;
use App\Services\Admin\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
        $this->app->bind(MembershipRepositoryInterface::class, MembershipRepository::class);
        $this->app->bind(MembershipPurchaseRepositoryInterface::class, MembershipPurchaseRepository::class);
        $this->app->bind(TrainingTypeRepositoryInterface::class, TrainingTypeRepository::class);
        $this->app->bind(TrainingRepositoryInterface::class, TrainingRepository::class);
        $this->app->bind(TrainingRegistrationRepositoryInterface::class, TrainingRegistrationRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);

        // Services
        $this->app->bind(AuthStaffService::class, function ($app) {
            return new AuthStaffService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(UserService::class, function ($app) {
            return new UserService(
                $app->make(UserRepositoryInterface::class),
                $app->make(RoleRepositoryInterface::class)
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
            );
        });

        $this->app->bind(TrainingRegistrationService::class, function ($app) {
            return new TrainingRegistrationService(
                $app->make(TrainingRegistrationRepositoryInterface::class),
                $app->make(UserRepositoryInterface::class),
                $app->make(TrainingRepositoryInterface::class)
            );
        });

        $this->app->bind(ScheduleService::class, function ($app) {
            return new ScheduleService(
                $app->make(ScheduleRepositoryInterface::class),
                $app->make(TrainingRepositoryInterface::class),
                $app->make(UserRepositoryInterface::class),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
