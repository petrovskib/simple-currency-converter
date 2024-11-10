<?php

namespace Tests\Unit;

use App\Domain\CurrencyConversion\Services\ICurrencyConversionService;
use App\Http\Controllers\API\V1\CurrencyConversionController;
use App\Http\Requests\CurrencyConversionRequest;
use App\Models\CurrencyConversion;
use Illuminate\Http\JsonResponse;
use Mockery;
use Tests\TestCase;

class CurrencyConversionControllerTest extends TestCase
{
    /** @test */
    public function it_returns_successful_response_when_currency_conversion_is_successful()
    {
        $currencyConversionMock = Mockery::mock(ICurrencyConversionService::class);
        $currencyConversionMock->shouldReceive('convertCurrency')
            ->once()
            ->andReturn(new CurrencyConversion([
                'source_currency' => 'USD',
                'target_currency' => 'EUR',
                'value' => 100,
                'converted_value' => 85,
                'rate' => 0.85,
            ]));

        $this->app->instance(ICurrencyConversionService::class, $currencyConversionMock);

        $data = [
            'source_currency' => 'USD',
            'target_currency' => 'EUR',
            'value' => 100,
        ];

        $controller = new CurrencyConversionController($currencyConversionMock);
        $response = $controller->convert(new CurrencyConversionRequest($data));

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('status', $response->getData(true));
        $this->assertArrayHasKey('message', $response->getData(true));
        $this->assertEquals('Amount converted successfully', $response->getData(true)['message']);
    }

    /** @test */
    public function it_returns_error_when_service_fails()
    {
        $currencyConversionMock = Mockery::mock(ICurrencyConversionService::class);
        $currencyConversionMock->shouldReceive('convertCurrency')
            ->once()
            ->andReturn(null);

        $this->app->instance(ICurrencyConversionService::class, $currencyConversionMock);

        $data = [
            'source_currency' => 'USD',
            'target_currency' => 'EUR',
            'value' => 100,
        ];

        $controller = new CurrencyConversionController($currencyConversionMock);
        $response = $controller->convert(new CurrencyConversionRequest($data));

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(400, $response->getStatusCode());

        $this->assertEquals('Error occurred while converting currencies!', $response->getData(true)['message']);
    }

    /** @test */
    public function it_returns_validation_errors_when_request_is_invalid()
    {
        $data = [
            'source_currency' => 'USD',
            'value' => 100,
        ];

        $response = $this->json('POST', '/api/convert', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['target_currency']);
    }

    /** @test */
    public function it_returns_validation_errors_on_invalid_input()
    {
        $data = [
            'source_currency' => 'USD',
            'value' => 100,
        ];

        $response = $this->json('POST', '/api/convert', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['target_currency']);
    }
}
