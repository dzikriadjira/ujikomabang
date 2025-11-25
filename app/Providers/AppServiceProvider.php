<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTPS in production (Railway, Heroku, etc.)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        // Alternative: Force HTTPS if APP_URL uses https
        if (config('app.url') && str_starts_with(config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }
}
