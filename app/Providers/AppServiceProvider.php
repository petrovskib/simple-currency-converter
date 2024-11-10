<?php

namespace App\Providers;

use App\Domain\Clients\ClientFactory;
use App\Domain\Clients\IClientFactory;
use App\Domain\CurrencyConversion\Services\CurrencyConversionService;
use App\Domain\CurrencyConversion\Services\ICurrencyConversionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ICurrencyConversionService::class, CurrencyConversionService::class);
        $this->app->bind(IClientFactory::class, ClientFactory::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
