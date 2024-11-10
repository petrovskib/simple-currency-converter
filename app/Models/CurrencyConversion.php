<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    public const SOURCE_CURRENCY = 'source_currency';
    public const TARGET_CURRENCY = 'target_currency';
    public const VALUE = 'value';
    public const CONVERTED_VALUE = 'converted_value';
    public const RATE = 'rate';
    protected $fillable = [
        'source_currency',
        'target_currency',
        'value',
        'converted_value',
        'rate'
    ];

    protected $hidden = [
        'id',
        'updated_at'
    ];
}
