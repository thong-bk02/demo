<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
            'birthday' => 'required',
            'address' => 'required|max:255',
            'phone' => 'required|unique:profile_users|max:12|min:10',
            'pword' => 'required|min:8|max:15'
        ];
    }

    public function messages() //dùng để Tùy chỉnh thông báo lỗi
    {
        return [
            'name.required' => ':attribute không được bỏ trống !',
            'name.max' => ':attribute quá dài',
            'email.required' => ':attribute không được bỏ trống !',
            'email.unique' => ':attribute đã tồn tại',
            'email.email' => ':attribute không đúng định dạng',
            'birthday.required' => ':attribute không được bỏ trống !',
            'address.required' => ':attribute không được bỏ trống !',
            'address.max' => ':attribute quá dài',
            'phone.required' => ':attribute không được bỏ trống !',
            'phone.unique' => ':attribute đã tồn tại',
            'phone.max' => ':attribute không quá :max số',
            'phone.min' => ':attribute phải có tối thiểu :min số',
            'pword.required' => ':attribute không được bỏ trống !',
            'pword.min' => ':attribute phải có tối thiểu :min kí tự',
            'pword.max' => ':attribute có tối đa :max kí tự',
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
            'pword' => 'Mật khẩu'
        ];
    }
}
