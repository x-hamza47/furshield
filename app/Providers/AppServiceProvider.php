<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Gate::define('admin-view', function ($user) {
            return $user->role == 'admin';
        });
        Gate::define('owner-view', function ($user) {
            return $user->role == 'owner';
        });
        Gate::define('vet-view', function ($user) {
            return $user->role == 'vet';
        });
        Gate::define('shelter-view', function ($user) {
            return $user->role == 'shelter';
        });
    }
}
