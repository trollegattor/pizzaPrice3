<?php

namespace App\Services\ProductSaveService;

use App\Facades\ProductSave;
use App\Parsers\Cafes\Models\ProductModel;
use App\Services\ProductSaveService\Contracts\ProductSaveServiceContract;

class ProductSaveService implements ProductSaveServiceContract
{
    /**
     * @param ProductModel $product
     * @return void
     */
    public function saveNewProducts(ProductModel $product): void
    {
        foreach ($product as $driverName => $item) {
            ProductSave::driver('Save' . $driverName)->saveData($item);
        }
    }
}
