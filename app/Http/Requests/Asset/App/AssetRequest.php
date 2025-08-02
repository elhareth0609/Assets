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
            'asset_name' => ['required', 'string', 'max:255'],
            'asset_number' => [
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
            // 'asset_type_id' => ['required', 'exists:asset_types,id'],
            // 'current_user_id' => ['nullable', 'exists:users,id'],
            // 'location_id' => ['nullable', 'exists:locations,id'],
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
            'asset_name' => 'Asset Name',
            'asset_number' => 'Asset Number',
            'purchase_date' => 'Purchase Date',
            'status' => 'Status',
            'notes' => 'Notes',
            'type' => 'Asset Type',
            'user' => 'Current User',
            'location' => 'Location',
            // 'asset_type_id' => 'Asset Type',
            // 'current_user_id' => 'Current User',
            // 'location_id' => 'Location',
            
        ];
    }
}
