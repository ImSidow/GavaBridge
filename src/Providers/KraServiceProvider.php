<?php

namespace GavaBridge\Kra\Providers;

use Illuminate\Support\ServiceProvider;
use GavaBridge\Kra\Support\KraManager;

class KraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/gavabridge.php', 'gavabridge');

        $this->app->singleton(KraManager::class, function ($app) {
            return new KraManager($app['config']->get('gavabridge', []));
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/gavabridge.php' => config_path('gavabridge.php'),
        ], 'gavabridge-config');
    }
}
