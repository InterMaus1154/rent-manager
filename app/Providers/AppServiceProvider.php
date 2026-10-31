<?php

namespace App\Providers;

use App\Services\AuthService;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(AuthService::class);
        $this->app->when(AuthService::class)
            ->needs(StatefulGuard::class)
            ->give(fn($app) => $app->make(Factory::class)->guard('web'));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
