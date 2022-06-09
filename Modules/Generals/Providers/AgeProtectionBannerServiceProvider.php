<?php

namespace Modules\Generals\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Generals\Http\Middleware\AgeProtectionBannerMiddleware;
use Modules\Generals\Entities\AgeProtectionBanner\Facades\AgeProtectionBanner;

class AgeProtectionBannerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->loadViewsFrom(__DIR__ . '/resources/views/', 'ageprotectionbanner');

        $router->middleware('ageprotectionbanner', 'Modules\Generals\Http\Middleware\AgeProtectionBannerMiddleware');

        if (config('ageprotectionbanner.autoregister') == null) {
            // Avoid complex situations on config:cache and production apps
            return;
        }

        foreach (config('ageprotectionbanner.autoregister') as $group) {
            $router->pushMiddlewareToGroup($group, AgeProtectionBannerMiddleware::class);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        if (config('ageprotectionbanner')) {
            $this->mergeConfigFrom(base_path() . '/config/ageprotectionbanner.php', 'ageprotectionbanner');
        }

        // Register the service the package provides.
        $this->app->singleton('ageprotectionbanner', function ($app) {
            return new AgeProtectionBanner;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ageprotectionbanner'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $publishTag = 'AgeProtectionBanner';

        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/config/ageprotectionbanner.php' => config_path('ageprotectionbanner.php'),
        ], $publishTag);

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('resources/views/vendor/ageprotectionbanner'),
        ], $publishTag);
    }
}
