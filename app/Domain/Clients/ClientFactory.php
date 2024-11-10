<?php

namespace App\Domain\Clients;

use App\Domain\Clients\Services\FixerIoCurrencyClient;
use App\Domain\Clients\Services\ICurrencyClient;
use Exception;

class ClientFactory implements IClientFactory
{
    /**
     * Choose the currency client based on the configuration.
     *
     * @return ICurrencyClient
     * @throws Exception
     */
    public static function create(): ICurrencyClient
    {
        $client = config('app.currencies_api.default_service');

        return match ($client) {
            'fixer' => new FixerIoCurrencyClient(),
            default => throw new Exception("Unsupported currency client: $client"),
        };
    }
}
