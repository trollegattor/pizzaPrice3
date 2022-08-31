<?php

namespace App\Facades;

use App\Parsers\CafeManager;
use Illuminate\Support\Facades\Facade;

class CafePrices extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return CafeManager::class;
    }
}
