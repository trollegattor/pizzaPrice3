<?php

namespace App\Services\ProductSaveService;

use App\Services\ProductSaveService\Contracts\ProductSaveServiceContract;
use Illuminate\Support\ServiceProvider;

class ProductSaveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductSaveServiceContract::class,ProductSaveService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
