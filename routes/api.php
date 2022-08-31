<?php

use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/pizza/parse')->group(function () {
    Route::get('/{pizzeria}', [PriceController::class, 'parsePrices']);
    Route::get('/', [PriceController::class, 'parseAllPrices']);
});
Route::prefix('v1/pizza')->group(function () {
    Route::get('/{pizzeria}', [PriceController::class, 'getPrices']);
    Route::get('/', [PriceController::class, 'getAllPrices']);
});
Route::get('/pizzerias', [PriceController::class, 'getEstablishment']);
