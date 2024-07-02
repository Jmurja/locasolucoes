<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        Gate::define('view-users', function($user) {
            return $user->role === 'admin' || $user->role === 'landlord';
        });
        Gate::define('view-reports', function($user) {
            return $user->role === 'admin';
        });
    }

    /**
     * Bootstrap any application services.
     */
}
