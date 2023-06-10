<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDanhMucRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // Sẽ lấy một số return để trả về đây
            'MaDM' => 'required|max:255',
            'TenDM' => 'required',    
        ];
    }
    // Tạo một cái message để hiển thị
    public function messages(): array
    {
        return [
            'TenDM.required' => 'Tên danh mục không được để trống',
            'MaDM.required' => 'Mã danh mục không được để trống',
        ];
    }
}
