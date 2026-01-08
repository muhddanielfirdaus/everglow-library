<?php

namespace App\Providers;

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
        // ⚠ REMOVE Blade::stringable closure – It causes type hint error in Laravel 12
        // If you need output escape, Blade already escapes by default using {{ }}
    }
}
