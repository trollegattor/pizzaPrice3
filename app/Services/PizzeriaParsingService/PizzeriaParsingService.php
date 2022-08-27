<?php

namespace App\Services\PizzeriaParsingService;

use App\Facades\PizzeriasPrices;
use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;

class PizzeriaParsingService implements PizzeriaParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return string[]
     */
    public function getPizzeriaPrices(string $pizzeria): array
    {
        $price = PizzeriasPrices::driver('ParsingPizzeria' . $pizzeria)->getPrices();
        return $price;
    }
}
