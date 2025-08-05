<?php

namespace App\Http\Requests\DepreciationEntry\App;

use Illuminate\Foundation\Http\FormRequest;

class EditDepreciationEntryRequest extends FormRequest {
    public function rules() {
        return [
            'entry_number' => 'required|string|max:255|unique:depreciation_entries,entry_number,' . $this->route('id'),
            'date' => 'required|date',
            'description' => 'required|string',
            'asset_id' => 'required|exists:assets,id',
            'depreciation_rate' => 'nullable|numeric|min:0|max:100',
            'depreciation_start_date' => 'nullable|date',
            'depreciation_year' => 'nullable|integer|min:2000|max:2100',
            'days_count' => 'nullable|integer|min:0',
            'purchase_cost' => 'nullable|numeric|min:0',
            'additions' => 'nullable|numeric|min:0',
            'exclusions' => 'nullable|numeric|min:0',
            'asset_cost_at_end' => 'nullable|numeric|min:0',
            'accumulated_depreciation_at_start' => 'nullable|numeric|min:0',
            'current_year_depreciation' => 'nullable|numeric|min:0',
            'excluded_depreciation' => 'nullable|numeric|min:0',
            'accumulated_depreciation_at_end' => 'nullable|numeric|min:0',
            'net_book_value' => 'nullable|numeric',
            'classification' => 'nullable|string|max:255',
        ];
    }
}
