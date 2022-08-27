<?php

use App\Http\Controllers\PizzaPriceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/pizza/parse')->group(function () {
    Route::get('/{pizzeria}', [PizzaPriceController::class, 'parsePrices']);
    Route::get('/', [PizzaPriceController::class, 'parseAllPrices']);
});
Route::prefix('v1/pizza')->group(function () {
    Route::get('/{pizzeria}', [PizzaPriceController::class, 'getPrices']);
    Route::get('/', [PizzaPriceController::class, 'getAllPrices']);
});
Route::get('/pizzerias', [PizzaPriceController::class, 'getEstablishment']);
