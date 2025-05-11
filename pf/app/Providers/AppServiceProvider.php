<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aquí puedes registrar servicios adicionales si es necesario
    }
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('currentUser', Auth::user());
        });
    }
}
