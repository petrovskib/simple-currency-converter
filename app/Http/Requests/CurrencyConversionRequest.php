<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CurrencyConversionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'source_currency' => 'required|string|size:3',
            'target_currency' => 'required|string|size:3',
            'value' => 'required|numeric|min:0.01',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'source_currency.required' => 'The source currency is required.',
            'source_currency.size' => 'The source currency must be exactly 3 characters.',
            'target_currency.required' => 'The target currency is required.',
            'target_currency.size' => 'The target currency must be exactly 3 characters.',
            'value.required' => 'The value is required.',
            'value.numeric' => 'The value must be a valid number.',
            'value.min' => 'The value must be at least 0.01.',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @param Validator $validator
     * @return HttpResponseException
     */
    protected function failedValidation(Validator $validator): HttpResponseException
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
