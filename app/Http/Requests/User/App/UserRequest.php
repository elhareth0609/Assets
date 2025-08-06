<?php

namespace App\Http\Requests\User\App;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    public function rules() {
        $rules = [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            // 'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $userId = $this->route('id'); 

            $rules['username'] = 'required|string|max:255|unique:users,username,' . $userId;
            // $rules['email'] = 'required|string|max:255|unique:users,email,' . $userId;

            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        return $rules;
    }

    public function messages() {
        return [
            'full_name.required' => 'حقل الاسم مطلوب',
            'full_name.string' => 'حقل الاسم يجب أن يكون نصاً',
            'full_name.max' => 'حقل الاسم يجب ان يكون اقل من 255 حرف',
            'username.required' => 'حقل الاسم المستخدم مطلوب',
            'username.string' => 'حقل الاسم المستخدم يجب ان يكون نصاً',
            'username.max' => 'حقل الاسم المستخدم يجب ان يكون اقل من 255 حرف',
            'username.unique' => 'الاسم المستخدم مستخدم بالفعل',
            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.string' => 'حقل كلمة المرور يجب ان يكون نصاً',
            'password.min' => 'حقل كلمة المرور يجب ان يكون اكثر من 8 حرف',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
        ];
    }
}
