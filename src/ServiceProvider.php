<?php

namespace Moh6mmad\LaravelSettings;

use Illuminate\Support\ServiceProvider;
use Moh6mmad\LaravelSettings\Console\InstallLaravelSettings;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Moh6mmad\LaravelSettings\Controllers\LaravelSettingsController');
        $this->app->make('Moh6mmad\LaravelSettings\Models\LaravelSettings');
        $this->loadViewsFrom(__DIR__.'/views', 'laravel-settings');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallLaravelSettings::class,
            ]);
        }
        include __DIR__.'/routes.php';
    }
}
