<?php

use App\Http\Controllers\API\V1\CurrencyConversionController;
use Illuminate\Support\Facades\Route;

Route::post('/convert', [CurrencyConversionController::class, 'convert']);
