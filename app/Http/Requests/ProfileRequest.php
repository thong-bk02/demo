<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ];
    }
    
    public function messages() //dùng để Tùy chỉnh thông báo lỗi
    {
        return [
            'old_password.required' => ':attribute không được bỏ trống !',
            'new_password.required' => ':attribute không được bỏ trống !',
            'new_password.confirmed' => ':attribute không trùng nhau !',
        ];
    }

     public function attributes() //dùng để Tùy chỉnh thuộc tính validation
    {
        return [
            'old_password' => 'Mật khẩu cũ',
            'new_password' => 'Mật khẩu mới'
        ];
    }
}
