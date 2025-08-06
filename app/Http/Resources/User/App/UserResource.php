<?php

namespace App\Http\Resources\User\App;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'full_name' => $this->name,
            'username' => $this->username,
        ];
    }
}
