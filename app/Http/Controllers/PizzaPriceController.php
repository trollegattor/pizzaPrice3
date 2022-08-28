<?php

namespace App\Http\Controllers;

use App\Services\PizzeriaParsingService\Contracts\PizzeriaParsingServiceContract;

class PizzaPriceController extends Controller
{
    public function parsePrices($pizzeria, PizzeriaParsingServiceContract $pizzeriaParsingService)
    {
        $price = $pizzeriaParsingService->getPizzeriaPrices($pizzeria);
        dd($price);

        return 'end';
    }

    public function parseAllPrices()
    {
        return 'parseAllPrices';
    }
    public function getPrices()
    {
        return 'getPrices';
    }
    public function getAllPrices()
    {
        return 'getAllPrices';
    }
    public function getEstablishment()
    {
        $list=$this->config->get('establishment');
        return 'getAllPrices';
    }

}
