<?php

namespace App\Providers;

use App\Interfaces\Admin\UserRepositoryInterface;
use App\Repositories\Admin\UserRepository;
use App\Services\Admin\Auth\AuthStaffService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Авторизация персонала
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthStaffService::class, function ($app) {
            return new AuthStaffService($app->make(UserRepositoryInterface::class));
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
