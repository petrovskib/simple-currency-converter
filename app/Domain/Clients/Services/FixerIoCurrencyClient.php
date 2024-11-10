<?php

namespace App\Domain\Clients\Services;


use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;


class FixerIoCurrencyClient implements ICurrencyClient
{
    protected string $apiUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.fixer.fixer_api_key');
        $this->apiUrl = config('services.fixer.fixer_api_url');
    }

    public function sendGetRequest(string $sourceCurrency, string $targetCurrency, float $value): Response
    {
        return Http::get($this->apiUrl, ['access_key' => $this->apiKey]);
    }
}
