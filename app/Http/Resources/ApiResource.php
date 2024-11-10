<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'baseCurrency' => $this->source_currency,
            'toCurrency' => $this->target_currency,
            'amountToBeConverted' => $this->value,
            'rate' => $this->rate,
            'amountConverted' => $this->converted_value,
            'dateOfConversion' => $this->created_at
        ];
    }
}
