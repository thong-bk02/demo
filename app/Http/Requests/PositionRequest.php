<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'position_code' => 'required|unique:positions',
            'position_name' => 'required|unique:positions'
        ];
    }

    public function messages() //dùng để Tùy chỉnh thông báo lỗi
    {
        return [
            'position_code.required' => ':attribute không được bỏ trống !',
            'position_code.unique' => ':attribute này đã được sử dụng',
            'position_name.required' => ':attribute không được bỏ trống !',
            'position_name.unique' => ':attribute này đã được sử dụng',
        ];
    }

     public function attributes() //dùng để Tùy chỉnh thuộc tính validation
    {
        return [
            'position_code' => 'Mã chức vụ',
            'position_name' => 'Tên chức vụ'
        ];
    }
}
