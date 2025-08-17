<?php

namespace GavaConnect\Kra\Providers;

use Illuminate\Support\ServiceProvider;
use GavaConnect\Kra\Support\KraManager;

class KraServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/kra.php', 'kra');

        $this->app->singleton(KraManager::class, function ($app) {
            return new KraManager($app['config']->get('kra'));
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/kra.php' => config_path('kra.php'),
        ], 'kra-config');
    }
}
