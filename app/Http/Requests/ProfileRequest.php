<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=> 'required|string|max:255',
            'email'=> 'nullable|string|max:255',
            'phone'=> 'required|digits:11,unique:users,phone',
            'lang' => 'required',
            'img' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ];
    }
}
