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
use App\Repositories\DiscountRepository;
use App\Repositories\MembershipPurchaseRepository;
use App\Repositories\MembershipRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\ReportRepository;
use App\Repositories\RoleRepository;
use App\Repositories\ScheduleRepository;
use App\Repositories\TrainingRegistrationRepository;
use App\Repositories\TrainingRepository;
use App\Repositories\TrainingTypeRepository;
use App\Repositories\UserRepository;
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
