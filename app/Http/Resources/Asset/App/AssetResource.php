<?php

namespace App\Http\Resources\Asset\App;

use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'number' => $this->number,
            'purchase_date' => $this->purchase_date,
            'status' => $this->status,
            'notes' => $this->notes,
            'type' => $this->type,
            'user' => $this->user,
            'location' => $this->location,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
