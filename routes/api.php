<?php

use App\Http\Controllers\PizzaPriceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/pizza')->group(function () {
    Route::get('/{pizzeria}', [PizzaPriceController::class, 'getPizzeriaPrices']);
    Route::get('/', [PizzaPriceController::class, 'allPizzeriasPrices']);
});
