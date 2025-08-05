<?php

namespace App\Http\Resources\Location\App;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}