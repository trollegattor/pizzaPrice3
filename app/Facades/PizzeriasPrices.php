<?php

namespace App\Facades;

use App\PizzeriaManager\PizzeriaManager;
use Illuminate\Support\Facades\Facade;

class PizzeriasPrices extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return PizzeriaManager::class;
    }
}
