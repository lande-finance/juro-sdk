<?php

namespace Hashstudio\JuroSdk;

use Illuminate\Support\ServiceProvider;

class JuroSdkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {



        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('juro-sdk.php'),
            ], 'juro-sdk-config');

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'juro-sdk');

        // Register the main class to use with the facade
        $this->app->singleton('juro-sdk', function () {
            return new JuroSdk(config('juro-sdk.api_key'), config('juro-sdk.debug'));
        });
    }
}
