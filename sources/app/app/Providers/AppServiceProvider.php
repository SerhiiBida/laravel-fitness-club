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
use App\Repositories\Admin\DiscountRepository;
use App\Repositories\Admin\MembershipPurchaseRepository;
use App\Repositories\Admin\MembershipRepository;
use App\Repositories\Admin\PermissionRepository;
use App\Repositories\Admin\ReportRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\ScheduleRepository;
use App\Repositories\Admin\TrainingRegistrationRepository;
use App\Repositories\Admin\TrainingRepository;
use App\Repositories\Admin\TrainingTypeRepository;
use App\Repositories\Admin\UserRepository;
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
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
