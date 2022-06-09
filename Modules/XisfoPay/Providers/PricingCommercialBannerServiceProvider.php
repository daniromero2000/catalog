<?php

namespace Modules\XisfoPay\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\XisfoPay\Http\Middleware\PricingCommercialBannerMiddleware;
use Modules\XisfoPay\Entities\PricingCommercialBanner\Facades\PricingCommercialBanner;

class PricingCommercialBannerServiceProvider extends ServiceProvider
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

        dd(config('pricingcommercialbanner'));
        $this->loadViewsFrom(__DIR__ . '/resources/views/', 'pricingcommercialbanner');

        $router->middleware('pricing_commercial', 'Modules\XisfoPay\Http\Middleware\PricingCommercialBannerMiddleware');

        if (config('pricingcommercialbanner.autoregister') == null) {
            // Avoid complex situations on config:cache and production apps
            return;
        }

        foreach (config('pricingcommercialbanner.autoregister') as $group) {
            $router->pushMiddlewareToGroup($group, PricingCommercialBannerMiddleware::class);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

        dd(config('pricingcommercialbanner'));
        if (config('pricingcommercialbanner')) {
            $this->mergeConfigFrom(base_path() . '/config/pricingcommercialbanner.php', 'pricingcommercialbanner');
        }

        // Register the service the package provides.
        $this->app->singleton('pricingcommercialbanner', function ($app) {
            return new PricingCommercialBanner;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pricingcommercialbanner'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        $publishTag = 'PricingCommercialBanner';

        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/config/pricingcommercialbanner.php' => config_path('pricingcommercialbanner.php'),
        ], $publishTag);

        // Publishing the views.
        $this->publishes([
            __DIR__ . '/resources/views' => base_path('resources/views/vendor/pricingcommercialbanner'),
        ], $publishTag);
    }
}
