<?php

namespace App\Providers;

use App\Interfaces\Admin\RoleRepositoryInterface;
use App\Interfaces\Admin\UserRepositoryInterface;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserRepository;
use App\Services\Admin\Auth\AuthStaffService;
use App\Services\Admin\RoleService;
use App\Services\Admin\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Auth
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthStaffService::class, function ($app) {
            return new AuthStaffService($app->make(UserRepositoryInterface::class));
        });
        // User
        $this->app->bind(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
        // Role
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RoleService::class, function ($app) {
            return new RoleService($app->make(RoleRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
