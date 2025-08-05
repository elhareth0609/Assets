<?php

namespace App\Http\Resources\Type\App;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource {
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}