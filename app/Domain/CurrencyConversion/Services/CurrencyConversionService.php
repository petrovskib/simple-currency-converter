<?php

namespace App\Domain\CurrencyConversion\Services;

use App\Domain\Clients\IClientFactory;
use App\Domain\Clients\Services\ICurrencyClient;
use App\Http\Requests\CurrencyConversionRequest;
use App\Models\CurrencyConversion;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyConversionService implements ICurrencyConversionService
{
    private ICurrencyClient $client;

    public function __construct(IClientFactory $factory)
    {
        $this->client = $factory::create();
    }

    public function convertCurrency(CurrencyConversionRequest $request): ?CurrencyConversion
    {

        try {
//            $response = $this->client->sendGetRequest($request->source_currency, $request->target_currency, $request->value);
//            //TODO: this code is commented due to subscription issues on FixerIo
//            //TODO: below is a example response which we are expecting

            $responseFake = [
                "success" => true,
                "query" => [
                    "from" => "GBP",
                    "to" => "JPY",
                    "amount" => 25
                ],
                "info" => [
                    "timestamp" => 1519328414,
                    "rate" => 148.972231
                ],
                "historical" => "",
                "date" => "2018-02-22",
                "result" => 3724.305775
            ];

            Http::fake(function () use ($responseFake) {
                return Http::response($responseFake, 200);
            });
            $response = $this->client->sendGetRequest($request->source_currency, $request->target_currency, $request->value);

            $jsonResponse = json_decode($response->getBody()->getContents(), true);

            if ($jsonResponse['success'] === false) {
                throw new \Exception(json_encode($jsonResponse));
            }

            return
                CurrencyConversion::create([
                    CurrencyConversion::SOURCE_CURRENCY => $response['query']['from'],
                    CurrencyConversion::TARGET_CURRENCY => $response['query']['to'],
                    CurrencyConversion::VALUE => $response['query']['amount'],
                    CurrencyConversion::CONVERTED_VALUE => $response['result'],
                    CurrencyConversion::RATE => $response['info']['rate'],
                ]);

        } catch (\Throwable $exception) {
            //TODO: in future will be better to log into Sentry.io
            Log::error($exception->getMessage());
            Log::error($exception->getTraceAsString());

            return null;
        }
    }
}
