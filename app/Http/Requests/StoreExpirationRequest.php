<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpirationRequest extends FormRequest
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
            'description' => 'required',
            'expiration_date' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'description.required' => 'Vui lòng điền lí do gia hạn',
            'expiration_date.required' => 'Vui lòng ngày gia hạn',
        ];
    }
}