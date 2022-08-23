<?php

namespace App\Http\Controllers;

use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;

class PizzaPriceController extends Controller
{
    public function getPizzeriaPrices($pizzeria, PizzeriaParsingServiceContract $pizzeriaParsingService)
    {
        $pizzeriaPrice = $pizzeriaParsingService->getPizzeriaPrices($pizzeria);

        return $pizzeriaPrice;
    }

    public function allPizzeriasPrices()
    {
        return 'all';
    }
}
