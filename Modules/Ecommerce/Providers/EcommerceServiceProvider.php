<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class EcommerceServiceProvider extends ServiceProvider
{

    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Ecommerce';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'ecommerce';

    private $categoryInterface;
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(
        CategoryRepositoryInterface $categoryRepositoryInterface
    ) {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
       // $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
       // $this->categoryInterface = $categoryRepositoryInterface;
       // $categories = $this->categoryInterface->listFrontCategories();
       // view()->share('categories', $categories);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(UseCaseServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(PayuClientServiceProvider::class);
        $this->app->bind('cart', 'Modules\Ecommerce\Entities\Shoppingcart\Cart');

        $this->app['events']->listen(Logout::class, function () {
            if ($this->app['config']->get('cart.destroy_on_logout')) {
                $this->app->make(SessionManager::class)->forget('cart');
            }
        });
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $config = __DIR__ . '/../Config/cart.php';
        $this->mergeConfigFrom($config, 'cart');

        $this->publishes([__DIR__ . '/../Config/payees.php' => config_path('payees.php')], 'config');
        $this->publishes([__DIR__ . '/../Config/bank-transfer.php' => config_path('bank-transfer.php')], 'config');
        $this->publishes([__DIR__ . '/../Config/efecty.php' => config_path('efecty.php')], 'config');
        $this->publishes([__DIR__ . '/../Config/baloto.php' => config_path('baloto.php')], 'config');
        $this->publishes([__DIR__ . '/../Config/cart.php' => config_path('cart.php')], 'config');
        $this->publishes([__DIR__ . '/../Config/payu.php' => config_path('payu.php')], 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        //  $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        // $this->publishes([
        //     $sourcePath => $viewPath
        // ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/ecommerce');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'ecommerce');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'ecommerce');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
