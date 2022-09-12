<?php

use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Route;

Route::get('/v', [PriceController::class, 'parsePrices']);
Route::get('/v1/pizza/delete', [PriceController::class, 'delete']);


