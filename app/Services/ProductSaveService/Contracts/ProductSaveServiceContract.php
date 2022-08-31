<?php

namespace App\Services\ProductSaveService\Contracts;

use App\Parsers\Cafes\Models\ProductModel;

interface ProductSaveServiceContract
{
    /**
     * @param ProductModel $product
     * @return void
     */
    public function saveNewProducts(ProductModel $product);
}
