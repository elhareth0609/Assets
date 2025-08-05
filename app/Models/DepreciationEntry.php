<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepreciationEntry extends Model
{
    protected $fillable = [
        'asset_id',
        'entry_number',
        'date',
        'description',
        'depreciation_rate',
        'depreciation_start_date',
        'depreciation_year',
        'days_count',
        'purchase_cost',
        'additions',
        'exclusions',
        'asset_cost_at_end',
        'accumulated_depreciation_at_start',
        'current_year_depreciation',
        'excluded_depreciation',
        'accumulated_depreciation_at_end',
        'net_book_value',
        'classification'
    ];

    protected $casts = [
        'date' => 'date',
        'depreciation_start_date' => 'date',
        'depreciation_rate' => 'decimal:2',
        'days_count' => 'integer',
        'purchase_cost' => 'decimal:2',
        'additions' => 'decimal:2',
        'exclusions' => 'decimal:2',
        'asset_cost_at_end' => 'decimal:2',
        'accumulated_depreciation_at_start' => 'decimal:2',
        'current_year_depreciation' => 'decimal:2',
        'excluded_depreciation' => 'decimal:2',
        'accumulated_depreciation_at_end' => 'decimal:2',
        'net_book_value' => 'decimal:2',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}