<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GoogleRequest extends FormRequest
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
        return [
            'token' => 'nullable|string',
            'device_type' => 'nullable|string|in:android,huawei,apple',
            'imei' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => __('validation.token_required'),
            'token.string' => __('validation.token_string'),
            'device_type.required' => __('validation.device_type_required'),
            'device_type.in' => __('validation.device_type_in'),
            'imei.required' => __('validation.imei_required'),
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation error',
            'errors'  => $validator->errors(),
        ], 422));
    }
}



