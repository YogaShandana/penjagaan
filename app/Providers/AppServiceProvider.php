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
        // Set timezone explicitly
        date_default_timezone_set(config('app.timezone'));
        
        // Register security observer for cross-role scan protection
        \App\Models\Scan::observe(\App\Observers\ScanObserver::class);
    }
}
