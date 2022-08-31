<?php

namespace App\Facades;

use App\Creators\ProductSaveManager;
use App\Creators\Models\SaveDishModel;
use Illuminate\Support\Facades\Facade;

class ProductSave extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ProductSaveManager::class;
    }
}
