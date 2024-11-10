<?php

namespace App\Domain\Clients\Services;

use Illuminate\Http\Client\Response;

interface ICurrencyClient
{

    /**
     * Convert a given value from source currency to target currency.
     *
     * @param string $sourceCurrency
     * @param string $targetCurrency
     * @param float $value
     * @return Response
     */
    public function sendGetRequest(string $sourceCurrency, string $targetCurrency, float $value): Response;
}
