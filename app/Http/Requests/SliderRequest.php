<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules= [
            'name_ar' => 'required|string|regex:/^[\p{Arabic}\s]+$/u',
            'name_en' => 'required|string|regex:/^[A-Za-z\s]+$/',
            "description_en" => "nullable|string|max:250|regex:/^[A-Za-z\s]+$/",
            "description_ar" => "nullable|string|max:250|regex:/^[\p{Arabic}\s]+$/u",
            'active' => 'required|boolean',
            'case_id' => 'nullable',
        ];
        if ($this->isMethod('post')) {
            $rules['image'] = "required|image|mimes:jpeg,png,jpg,gif|max:2048";
        } else if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['image'] = "nullable|image|mimes:jpeg,png,jpg,gif|max:2048";
        }
        return $rules;
    }
}
