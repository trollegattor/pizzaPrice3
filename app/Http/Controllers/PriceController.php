<?php

namespace App\Http\Controllers;

use App\Services\ProductSaveService\ProductSaveService;
use App\Services\CafeParsingService\Contracts\CafeParsingServiceContract;

class PriceController extends Controller
{
    public function parsePrices($cafe, CafeParsingServiceContract $cafeParsingService, ProductSaveService $productSaveService)
    {
        $price = $cafeParsingService->getCafePrices($cafe);
        $productSaveService->saveNewProducts($price);


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
