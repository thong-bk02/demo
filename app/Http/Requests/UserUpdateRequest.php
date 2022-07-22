<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required|max:50',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($this->id, 'id')],
            'birthday' => 'required',
            'address' => 'required|max:255',
            'phone' => ['required','max:12','min:10', Rule::unique('profile_users', 'phone')->ignore($this->id, 'user_id')],
        ];
    }

    public function messages() //dùng để Tùy chỉnh thông báo lỗi
    {
        return [
            'name.required' => ':attribute không được bỏ trống !',
            'name.max' => ':attribute quá dài',
            'email.required' => ':attribute không được bỏ trống !',
            'email.unique' => ':attribute này đã được sử dụng',
            'email.email' => ':attribute không đúng định dạng',
            'birthday.required' => ':attribute không được bỏ trống !',
            'address.required' => ':attribute không được bỏ trống !',
            'address.max' => ':attribute quá dài',
            'phone.required' => ':attribute không được bỏ trống !',
            'phone.unique' => ':attribute này đã được sử dụng',
            'phone.max' => ':attribute không quá :max số',
            'phone.min' => ':attribute phải có tối thiểu :min số',
        ];
    }

     public function attributes() //dùng để Tùy chỉnh thuộc tính validation
    {
        return [
            'name' => 'Tên',
            'email' => 'Email',
            'birthday' => 'Ngày sinh',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
        ];
    }
}
