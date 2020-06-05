<?php

namespace CodeWizz\Amazon\ProductAdvertising;

use Illuminate\Support\ServiceProvider;

class AmazonProductServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/amazon-product.php', 'amazon-product');

        $this->app->singleton(AmazonProduct::class, function () {
            return new AmazonProduct();
        });

        $this->app->alias(AmazonProduct::class, 'amazon-product');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/amazon-product.php' => config_path('amazon-product.php')
            ], 'amazon-product');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'amazon-product'
        ];
    }
}
