<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;    

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force all URLs (including @vite asset links) to use HTTPS
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
