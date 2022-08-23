<?php

namespace App\Services\PizzeriaParsingService;

use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;
use Illuminate\Support\ServiceProvider;

class PizzeriaParsingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PizzeriaParsingServiceContract::class, PizzeriaParsingService::class);
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
