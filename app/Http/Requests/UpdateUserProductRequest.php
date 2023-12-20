<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProductRequest extends FormRequest
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
        $is3D = $this->request->get('is_3d');
        if(isset($is3D) || $is3D == true){
            return [
                'hour_to' => 'required',
                'to_hour' => 'required',
                'total_hour' => 'required|numeric',
                'created_at' => 'required',
            ];
        }else{
            return [
                'balls' => 'required|numeric',
                'created_at' => 'required',
            ];
        }
    }
    public function messages(): array
    {
        return [
            'hour_to.required' => 'Vui lòng điền giờ vào',
            'to_hour.required' => 'Vui lòng điền giờ ra',
            'total_hour.required' => 'Vui lòng tổng số giờ',
            'total_hour.numeric' => 'Số giờ phải là số',
            'balls.required' => 'Vui lòng số bóng',
            'balls.numeric' => 'Số bóng phải là số',
            'created_at.required' => 'Vui lòng điền ngày',
        ];
    }
}