<?php

namespace App\Services\CafeParsingService\Contracts;

use App\Parsers\Cafes\Models\ProductModel;

interface CafeParsingServiceContract
{
    /**
     * @param string $cafe
     * @return ProductModel
     */
    public function getCafePrices(string $cafe): ProductModel;
}
