<?php

namespace App\Domain\Clients;

use App\Domain\Clients\Services\ICurrencyClient;

interface IClientFactory
{
    public static function create(): ICurrencyClient;

}
