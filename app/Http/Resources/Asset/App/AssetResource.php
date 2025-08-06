<?php

namespace App\Http\Resources\Asset\App;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'manufacturer_serial' => $this->manufacturer_serial,
            'purchase_date' => $this->purchase_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'type_id' => $this->type_id,
            'employee_id' => $this->employee_id,
            'location_id' => $this->location_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
