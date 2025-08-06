<?php

namespace App\Http\Requests\DepreciationEntry\App;

use Illuminate\Foundation\Http\FormRequest;

class EditDepreciationEntryRequest extends FormRequest {
    public function rules() {
        return [
            'entry_number' => 'required|string|max:255|unique:depreciation_entries,entry_number,' . $this->route('id'),
            'date' => 'required|date',
            'description' => 'required|string',
            'asset_id' => 'required|exists:assets,id',
            'depreciation_rate' => 'nullable|numeric|min:0|max:100',
            'depreciation_start_date' => 'nullable|date',
            'depreciation_year' => 'nullable|integer|min:2000|max:2100',
            'days_count' => 'nullable|integer|min:0',
            'purchase_cost' => 'nullable|numeric|min:0',
            'additions' => 'nullable|numeric|min:0',
            'exclusions' => 'nullable|numeric|min:0',
            'asset_cost_at_end' => 'nullable|numeric|min:0',
            'accumulated_depreciation_at_start' => 'nullable|numeric|min:0',
            'current_year_depreciation' => 'nullable|numeric|min:0',
            'excluded_depreciation' => 'nullable|numeric|min:0',
            'accumulated_depreciation_at_end' => 'nullable|numeric|min:0',
            'net_book_value' => 'nullable|numeric',
            'classification' => 'nullable|string|max:255',
        ];
    }

    public function authorize() {
        return true; // TODO: Implement authorize() method.
    }

    public function messages() {
        return [
            'entry_number.required' => 'حقل رقم الدفعة مطلوب',
            'entry_number.string' => 'حقل رقم الدفعة يجب ان يكون نصا',
            'entry_number.unique' => 'حقل رقم الدفعة يجب ان يكون فريد',
            'date.required' => 'حقل التاريخ مطلوب',
            'date.date' => 'حقل التاريخ يجب ان يكون تاريخا',
            'description.required' => 'حقل الوصف مطلوب',
            'description.string' => 'حقل الوصف يجب ان يكون نصا',
            'asset_id.required' => 'حقل الصنف مطلوب',
            'asset_id.exists' => 'حقل الصنف غير صحيح',
            'depreciation_rate.numeric' => 'حقل نسبة الاستحقاق يجب ان يكون رقما',
            'depreciation_rate.min' => 'حقل نسبة الاستحقاق يجب ان يكون اكبر من 0',
            'depreciation_rate.max' => 'حقل نسبة الاستحقاق يجب ان يكون اقل من 100',
            'depreciation_start_date.date' => 'حقل تاريخ بدء الاستحقاق يجب ان يكون تاريخا',
            'depreciation_year.integer' => 'حقل سنة الاستحقاق يجب ان يكون رقما',
            'depreciation_year.min' => 'حقل سنة الاستحقاق يجب ان يكون اكبر من 2000',
            'depreciation_year.max' => 'حقل سنة الاستحقاق يجب ان يكون اقل من 2100',
            'days_count.integer' => 'حقل عدد الايام يجب ان يكون رقما',
            'days_count.min' => 'حقل عدد الايام يجب ان يكون اكبر من 0',
            'purchase_cost.numeric' => 'حقل تكلفة الاصل يجب ان يكون رقما',
            'purchase_cost.min' => 'حقل تكلفة الاصل يجب ان يكون اكبر من 0',
            'additions.numeric' => 'حقل الاضافات يجب ان يكون رقما',
            'additions.min' => 'حقل الاضافات يجب ان يكون اكبر من 0',
            'exclusions.numeric' => 'حقل الاستبعادات يجب ان يكون رقما',
            'exclusions.min' => 'حقل الاستبعادات يجب ان يكون اكبر من 0',
            'current_year_depreciation.numeric' => 'حقل استحقاق السنة الحالية يجب ان يكون رقما',
            'current_year_depreciation.min' => 'حقل استحقاق السنة الحالية يجب ان يكون اكبر من 0',        
        ];
    }
}
