<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/pt_BR.json' => $this->app->langPath() . '/pt_BR.json',
            __DIR__ . '/pt_BR' => $this->app->langPath() . '/pt_BR'
        ], 'laravel-pt-br-localization');
    }
}
