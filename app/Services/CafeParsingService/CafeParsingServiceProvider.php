<?php

namespace App\Services\CafeParsingService;

use App\Services\CafeParsingService\Contracts\CafeParsingServiceContract;
use Illuminate\Support\ServiceProvider;

class CafeParsingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CafeParsingServiceContract::class, CafeParsingService::class);
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
