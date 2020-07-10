<?php

namespace Alwathan\LaraUpdater;

use Illuminate\Support\ServiceProvider;

class LaraUpdaterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->publishes([
            __DIR__.'/laraupdater.php' => config_path('laraupdater.php'),
        ]);
        $this->app->make('Alwathan\LaraUpdater\LaraUpdaterController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/routes.php';
    }
}
