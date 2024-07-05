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
        Gate::define('simple-user', function($user) {
            return $user->role !== 'visitor' && $user->role !== 'tenant';
        });
    }

    /**
     * Bootstrap any application services.
     */
}
