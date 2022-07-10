<?php

namespace App\Exports;

use App\Models\Timekeeping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TimeKeepingExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Timekeeping::all();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ID", "ID Nhân sự", "Ngày Bắt Đầu", "Ngày hiện tại", "Số ngày công", "Số lần đi muộn", "Số giờ đi muộn", "Số lần về sớm", "Số giờ về sớm", "Ngày tạo", "Ngày cập nhật"];
    }

    public function map($timekeepings): array
    {
        return [
            $timekeepings->id,
            $timekeepings->user_id,
            $timekeepings->from_date,
            $timekeepings->to_date,
            $timekeepings->working_days,
            $timekeepings->arrive_late,
            $timekeepings->hours_late,
            $timekeepings->leave_early,
            $timekeepings->hours_early,
        ];
    }
}
