<?php

namespace App\Http\Resources\Employee\App;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'full_name' => $this->name,
        ];
    }
}