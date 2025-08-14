<?php

namespace App\Http\Resources\Institution;

use Illuminate\Http\Resources\Json\JsonResource;

class InstitutionResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status
        ];
    }
}