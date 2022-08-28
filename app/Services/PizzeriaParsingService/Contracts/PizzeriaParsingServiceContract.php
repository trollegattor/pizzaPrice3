<?php

namespace App\Services\PizzeriaParsingService\Contracts;

use App\Pizzerias\ProductModel;

interface PizzeriaParsingServiceContract
{
    /**
     * @param string $pizzeria
     * @return ProductModel
     */
    public function getPizzeriaPrices(string $pizzeria): ProductModel;
}
