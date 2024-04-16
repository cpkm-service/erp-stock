<?php

namespace Cpkm\ErpStock;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;

class ErpStockServiceProvider extends ServiceProvider
{
    protected $events = [
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        $this->mergeConfigFrom(__DIR__.'/../config/erp-stock.php', 'erp-stock');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php','erp-stock');
        $this->loadViewsFrom(__DIR__.'/../resources/views/erp-stock', 'erp-stock');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'erp-stock');
        $this->loadMigrationsFrom(__DIR__ .'/../database/migrations');

        $this->publishes([
            __DIR__.'/../resources/views/erp-stock' => resource_path('views/vendor/erp-stock'),
        ], 'erp-stock-views');

        $this->publishes([
            __DIR__.'/../lang' => lang_path('vendor/erp-stock'),
        ], 'erp-stock-translations');

        $this->publishes([
            __DIR__.'/../config/erp-stock.php' => config_path('erp-stock.php'),
        ], 'erp-stock-config');
        
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'erp-stock-migrations');
        
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
