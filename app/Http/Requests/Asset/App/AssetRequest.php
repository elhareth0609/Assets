<?php

namespace App\Http\Requests\Asset\App;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'manufacturer_serial' => ['required', 'string', 'max:255'],
            'number' => [
                'required',
                'string',
                'max:255',
                $this->isMethod('put') || $this->isMethod('patch')
                    ? Rule::unique('assets')->ignore($this->id)
                    : Rule::unique('assets')
            ],
            'purchase_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['in_use', 'in_storage', 'maintenance', 'damaged'])],
            'notes' => ['nullable', 'string'],
            'type_id' => ['nullable', 'exists:types,id'],
            'emplyee_id' => ['nullable', 'exists:emplyees,id'],
            'location_id' => ['nullable', 'exists:locations,id'],
        ];

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            'name' => 'Name',
            'number' => 'Number',
            'purchase_date' => 'Purchase Date',
            'status' => 'Status',
            'notes' => 'Notes',
            'type_id' => 'Type',
            'emplyee_id' => 'Employee',
            'location_id' => 'Location',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'حقل الاسم مطلوب',
            'name.string' => 'حقل الاسم يجب أن يكون نصاً',
            'name.max' => 'حقل الاسم يجب ألا يزيد عن 255 حرفاً',
            'manufacturer_serial.required' => 'حقل الرقم التسلسلي للشركة المصنعة مطلوب',
            'manufacturer_serial.string' => 'حقل الرقم التسلسلي للشركة المصنعة يجب أن يكون نصاً',
            'manufacturer_serial.max' => 'حقل الرقم التسلسلي للشركة المصنعة يجب ألا يزيد عن 255 حرفاً',
            'number.required' => 'حقل الرقم مطلوب',
            'number.string' => 'حقل الرقم يجب أن يكون نصاً',
            'number.max' => 'حقل الرقم يجب ألا يزيد عن 255 حرفاً',
            'number.unique' => 'الرقم مستخدم بالفعل',
            'purchase_date.date' => 'حقل تاريخ الشراء يجب أن يكون تاريخاً صالحاً',
            'status.required' => 'حقل الحالة مطلوب',
            'status.in' => 'حقل الحالة يجب أن يكون إحدى القيم التالية: قيد الاستخدام، في المخزن، تحت الصيانة، تالف',
            'notes.string' => 'حقل الملاحظات يجب أن يكون نصاً',
            'type_id.exists' => 'النوع المحدد غير موجود',
            'emplyee_id.exists' => 'الموظف المحدد غير موجود',
            'location_id.exists' => 'الإدارة المحدد غير موجود'
        ];
    }

}
