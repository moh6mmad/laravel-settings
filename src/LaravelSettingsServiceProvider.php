<?php

namespace Moh6mmad\LaravelSettings;

use Illuminate\Support\ServiceProvider;

class LaravelSettingsServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        include __DIR__.'/routes.php';
    }
}
