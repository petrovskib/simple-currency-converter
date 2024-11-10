<?php

namespace App\Domain\CurrencyConversion\Services;

use App\Http\Requests\CurrencyConversionRequest;
use Illuminate\Database\Eloquent\Model;

interface ICurrencyConversionService
{
    public function convertCurrency(CurrencyConversionRequest $request): ?Model;
}
