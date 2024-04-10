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
        // $this->mergeConfigFrom(__DIR__.'/../config/excel.php', 'excel');

        // $this->loadRoutesFrom(__DIR__.'/../routes/web.php','excel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views/excel', 'excel');
        // $this->loadTranslationsFrom(__DIR__.'/../lang', 'excel');
        // $this->loadMigrationsFrom(__DIR__ .'/../database/migrations');

        // $this->publishes([
        //     __DIR__.'/../resources/views/excel' => resource_path('views/vendor/excel'),
        // ], 'excel-views');

        // $this->publishes([
        //     __DIR__.'/../lang' => lang_path('vendor/excel'),
        // ], 'excel-translations');

        // $this->publishes([
        //     __DIR__.'/../config/excel.php' => config_path('excel.php'),
        // ], 'excel-config');
        
        // $this->publishes([
        //     __DIR__.'/../database/migrations' => database_path('migrations'),
        // ], 'excel-migrations');

        
        // Blade::componentNamespace('Cpkm\\Excel\\View\\Components\\Backend', 'backend');
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
