<?php

namespace App\Providers;

use App\Interfaces\MembershipRepositoryInterface;
use App\Interfaces\TrainingRegistrationRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Services\API\Auth\AuthService;
use App\Services\API\MembershipService;
use App\Services\API\TrainingService;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Services
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(UserRepositoryInterface::class));
        });

        $this->app->bind(MembershipService::class, function ($app) {
            return new MembershipService($app->make(MembershipRepositoryInterface::class));
        });

        $this->app->bind(TrainingService::class, function ($app) {
            return new TrainingService($app->make(TrainingRegistrationRepositoryInterface::class));
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
