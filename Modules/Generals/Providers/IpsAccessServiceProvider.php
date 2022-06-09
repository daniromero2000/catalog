<?php

namespace Modules\Generals\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Generals\Http\Middleware\IpsAccessMiddleware;
use Modules\Generals\Entities\IpsAccess\Facades\IpsAccess;

class IpsAccessServiceProvider extends ServiceProvider
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

        $this->loadViewsFrom(__DIR__ . '/resources/views/', 'ipsaccess');

        $router->middleware('ipsaccess', 'Modules\Generals\Http\Middleware\IpsAccessMiddleware');

        if (config('ipsaccess.autoregister') == null) {
            // Avoid complex situations on config:cache and production apps
            return;
        }

        foreach (config('ipsaccess.autoregister') as $group) {
            $router->pushMiddlewareToGroup($group, IpsAccessMiddleware::class);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        if (config('ipsaccess')) {
            $this->mergeConfigFrom(base_path() . '/config/ipsaccess.php', 'ipsaccess');
        }

        // Register the service the package provides.
        $this->app->singleton('ipsaccess', function ($app) {
            return new IpsAccess;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ipsaccess'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $publishTag = 'ipsaccess';

        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/config/ipsaccess.php' => config_path('ipsaccess.php'),
        ], $publishTag);

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('resources/views/vendor/ipsaccess'),
        ], $publishTag);
    }
}
