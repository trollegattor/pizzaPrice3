<?php

namespace App\Services\PizzeriaParsingService;

use App\Facades\PizzeriasPrices;
use App\Pizzerias\ProductModel;
use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;

class PizzeriaParsingService implements PizzeriaParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return ProductModel
     */
    public function getPizzeriaPrices(string $pizzeria): ProductModel
    {
        $price = PizzeriasPrices::driver('ParsingPizzeria' . $pizzeria)->getPrices();
        return $price;
    }
}
