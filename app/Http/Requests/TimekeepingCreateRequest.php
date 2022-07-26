<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimekeepingCreateRequest extends FormRequest
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
            'timekeeping_month' => 'required',
            'working_days' => 'required|numeric|min:0|max:31',
            'day_off' => 'required|numeric|min:0|max:31',
            'arrive_late' => 'required|numeric|min:0',
            'hours_late' => 'required|numeric|min:0',
            'leave_early' => 'required|numeric|min:0',
            'hours_early' => 'required|numeric|min:0',
        ];
    }

    public function messages() //dùng để Tùy chỉnh thông báo lỗi
    {
        return [
            '*.required' => ':attribute không được bỏ trống !',
            '*.numeric' => ':attribute phải là số',
            '*.min' => ':attribute không hợp lệ',
            '*.max' => ':attribute không hợp lệ',
        ];
    }

     public function attributes() //dùng để Tùy chỉnh thuộc tính validation
    {
        return [
            'timekeeping_month' => 'tháng công',
            'working_days' => 'tổng ngày công',
            'day_off' => 'ngày nghỉ',
            'arrive_late' => 'số lần đi muộn',
            'hours_late' => 'tổng giờ đi muộn',
            'leave_early' => 'số lần về sớm',
            'hours_early' => 'tổng giờ về sớm',
        ];
    }
}
