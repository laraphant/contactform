<?php

namespace Laraphant\Contactform;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //dd(123);

        $this->publishes([
            __DIR__.'/../config/config.php'=>config_path('contactform.php')
        ],'contactform-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views','contactform');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');


    }
}
