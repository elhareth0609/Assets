<?php

namespace App\Http\Requests\Location\App;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest {
    public function rules() {
        return [
            'name' => 'required|string',
        ];
    }
}