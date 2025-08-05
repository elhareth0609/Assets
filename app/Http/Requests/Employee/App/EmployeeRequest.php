<?php

namespace App\Http\Requests\Employee\App;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest {
    public function rules() {
        return [
            'full_name' => 'required|string',
        ];
    }
}