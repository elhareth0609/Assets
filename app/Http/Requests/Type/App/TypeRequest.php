<?php

namespace App\Http\Requests\Type\App;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest {
    public function rules() {
        return [
            'name' => 'required|string',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'حقل الاسم مطلوب',
            'name.string' => 'حقل الاسم يجب أن يكون نصاً',
        ];
    }
}