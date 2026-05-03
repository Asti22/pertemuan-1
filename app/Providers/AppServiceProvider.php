<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route;

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
        /**
         * Konfigurasi Scramble untuk Dokumentasi API
         * Ini akan memfilter agar hanya rute berawalan 'api/' yang muncul di dokumen
         */
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });

        /**
         * Gate Otorisasi
         */
        
        // Gate untuk Export Product (Hanya Admin)
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk Akses Menu Category
        Gate::define('access-category', function (User $user) {
            return $user->role === 'admin';
        });

        // Izin untuk melihat dokumentasi Scramble
        Gate::define('viewApiDocs', function (?User $user) {
            return true; 
        });
    }
}