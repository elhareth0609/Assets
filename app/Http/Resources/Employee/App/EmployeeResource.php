<?php

namespace App\Http\Resources\Employee\App;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'full_name' => $this->name,
            'email' => $this->email,
            'location_id' => $this->location_id,
            'job_title' => $this->job_title,
        ];
    }
}
