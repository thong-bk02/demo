<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\registerEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimekeepingExportOne implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $timekeeping = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', '=', 'users.id')
            ->join('profile_users', 'timekeepings.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->select('users.name', 'timekeepings.*', 'positions.position_name', 'departments.department')
            ->where("timekeepings.timekeeping_code", session()->get('timekeeping_code'))
            ->select('users.name', 'positions.position_name', 'departments.department', 'timekeeping_month', 'working_days', 'day_off', 'arrive_late', 'hours_late', 'leave_early', 'hours_early', 'timekeepings.created_at')
            ->get();
        return $timekeeping;
    }

    public function headings(): array
    {
        return [
            ['Bảng chấm công'],
            ["Tên nhân sự", "Chức vụ", "Phòng ban", "Tháng công", "Số ngày công", "số ngày nghỉ", "Số lần đi muộn", "Số giờ đi muộn", "Số lần về sớm", "Số giờ về sớm", "Thời gian tạo"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('2')->getFont()->setBold(true);
        $sheet->getStyle('2')->getFont()->setSize(14);
        $cellRange = 'A2:K2';
        $color = 'c4c1c0';
        $sheet->getStyle($cellRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB($color);
    }

    public function map($timekeeping): array
    {
        return [
            $timekeeping->name,
            $timekeeping->position_name,
            $timekeeping->department,
            $timekeeping->timekeeping_month,
            $timekeeping->working_days,
            $timekeeping->day_off,
            $timekeeping->arrive_late,
            $timekeeping->hours_late,
            $timekeeping->leave_early,
            $timekeeping->hours_early,
            $timekeeping->created_at,
        ];
    }
}
