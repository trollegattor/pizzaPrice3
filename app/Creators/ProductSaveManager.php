<?php

namespace App\Creators;

use App\Creators\Models\SaveDishModel;
use App\Creators\Models\SaveToppingModel;
use Illuminate\Support\Manager;

class ProductSaveManager extends Manager
{
    public function getDefaultDriver()
    {
        $default='SaveDishModel';
            return $default;
    }
    public function createSaveDishModelDriver()
    {
        return new SaveDishModel;
    }
    public function createSaveToppingModelDriver()
    {
        return new SaveToppingModel;
    }
}
