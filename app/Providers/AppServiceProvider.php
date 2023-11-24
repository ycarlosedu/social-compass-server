<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Routing\UrlGenerator;

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

    public function boot(UrlGenerator $url)
    {
        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
