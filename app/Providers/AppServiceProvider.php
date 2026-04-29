<?php

namespace App\Providers;

use App\Models\User;
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
        // Gate untuk Export Product (Hanya Admin)
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk Akses Menu Category (Sesuai tugas terakhir lu)
        Gate::define('access-category', function (User $user) {
            return $user->role === 'admin';
        });
    }
}