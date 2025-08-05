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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'number' => [
                'required',
                'string',
                'max:255',
                $this->isMethod('put') || $this->isMethod('patch')
                    ? Rule::unique('assets')->ignore($this->asset)
                    : Rule::unique('assets')
            ],
            'purchase_date' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['in_use', 'in_storage', 'maintenance', 'damaged'])],
            'notes' => ['nullable', 'string'],
            'type' => ['required'],
            'user' => ['nullable'],
            'location' => ['nullable'],
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
    public function attributes()
    {
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
}
