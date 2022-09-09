<?php

namespace App\Jobs;

use App\Facades\CafePrices;
use App\Services\ProductSaveService\ProductSaveService;
use Illuminate\Foundation\Bus\Dispatchable;

class CafeParsing
{
    use Dispatchable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ProductSaveService $productSaveService)
    {
        foreach (config('cafes') as $item) {
            $price = CafePrices::driver('ParsingCafe' . $item['driver'])->getPrices();
            $productSaveService->saveNewProducts($price);
        }
    }
}
