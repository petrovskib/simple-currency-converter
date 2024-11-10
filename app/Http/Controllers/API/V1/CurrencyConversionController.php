<?php

namespace App\Http\Controllers\API\V1;

use App\Domain\CurrencyConversion\Services\ICurrencyConversionService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyConversionRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class CurrencyConversionController extends Controller
{
    protected ICurrencyConversionService $currencyConversionService;

    public function __construct(ICurrencyConversionService $currencyConversionService)
    {

        $this->currencyConversionService = $currencyConversionService;
    }

    public function convert(CurrencyConversionRequest $request): JsonResponse
    {
        $model = $this->currencyConversionService->convertCurrency($request);

        return ApiResponse::returnSuccessOrFailedResponseWithResource(
            $model,
            'Amount converted successfully',
            'Error occurred while converting currencies!'
        );
    }
}
