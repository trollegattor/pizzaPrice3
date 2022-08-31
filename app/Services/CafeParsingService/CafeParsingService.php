<?php

namespace App\Services\CafeParsingService;

use App\Facades\CafePrices;
use App\Parsers\Cafes\Models\ProductModel;
use App\Services\CafeParsingService\Contracts\CafeParsingServiceContract;

class CafeParsingService implements CafeParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return ProductModel
     */
    public function getCafePrices(string $cafe): ProductModel
    {
        $price = CafePrices::driver('ParsingCafe' . $cafe)->getPrices();
        return $price;
    }
}
