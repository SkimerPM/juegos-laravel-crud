<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL; // <--- ¡IMPORTANTE! Añade esta línea

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        } // <--- ESTE CORCHETE CIERRA EL 'if'

    } // <--- ¡AÑADE ESTE CORCHETE! Este cierra el método 'boot()'
}