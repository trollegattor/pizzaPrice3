<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Services\ProductSaveService\ProductSaveService;
use App\Services\CafeParsingService\Contracts\CafeParsingServiceContract;
use Illuminate\Http\RedirectResponse;

class PriceController extends Controller
{
    /**
     * @param CafeParsingServiceContract $cafeParsingService
     * @param ProductSaveService $productSaveService
     * @return RedirectResponse
     */
    public function parsePrices(CafeParsingServiceContract $cafeParsingService, ProductSaveService $productSaveService)
    {
        $price = $cafeParsingService->getCafePrices(key(config('cafes')));
        $productSaveService->saveNewProducts($price);

        return redirect()->back();
    }

    public function delete()
    {
        while (Pizza::query()->first()) {
            $pizza = Pizza::query()->first();
            //$pizza->delete();
        }
    }
}
