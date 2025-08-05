<?php

namespace App\Http\Resources\DepreciationEntry\App;

use Illuminate\Http\Resources\Json\JsonResource;

class DepreciationEntryResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'asset_id' => $this->asset_id,
            'entry_number' => $this->entry_number,
            'date' => $this->date,
            'description' => $this->description,
            'depreciation_rate' => $this->depreciation_rate,
            'depreciation_start_date' => $this->depreciation_start_date,
            'depreciation_year' => $this->depreciation_year,
            'days_count' => $this->days_count,
            'purchase_cost' => $this->purchase_cost,
            'additions' => $this->additions,
            'exclusions' => $this->exclusions,
            'asset_cost_at_end' => $this->asset_cost_at_end,
            'accumulated_depreciation_at_start' => $this->accumulated_depreciation_at_start,
            'current_year_depreciation' => $this->current_year_depreciation,
            'excluded_depreciation' => $this->excluded_depreciation,
            'accumulated_depreciation_at_end' => $this->accumulated_depreciation_at_end,
            'net_book_value' => $this->net_book_value,
            'classification' => $this->classification,
        ];
    }
}
