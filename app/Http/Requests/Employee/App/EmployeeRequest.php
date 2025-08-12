<?php

namespace App\Http\Requests\Employee\App;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest {
    public function rules() {
        return [
            'full_name' => 'required|string',
            'email' => 'nullable|email',
            'job_title' => 'nullable|string',
            'location_id' => 'nullable|exists:locations,id',
        ];
    }

    public function messages() {
        return [
            'full_name.required' => 'حقل الاسم مطلوب',
            'full_name.string' => 'حقل الاسم يجب أن يكون نصاً',
            'email.email' => 'حقل البريد الالكتروني يجب ان يكون بصيغة البريد الالكتروني',
            'location_id.exists' => 'حقل الموقع غير صحيح',
            'job_title.string' => 'حقل الوظيفة يجب ان يكون نصاً',
        ];
    }
}