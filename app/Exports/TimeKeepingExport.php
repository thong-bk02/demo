<?php

namespace App\Exports;

use App\Models\Timekeeping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimeKeepingExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithMapping, WithColumnFormatting, WithCustomValueBinder
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = session('timekeeping');
        // $demo = session()->get('timekeeping.name'); dd($demo);
        $timekeeping = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', '=', 'users.id')
            ->join('profile_users', 'timekeepings.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->select('users.name','users.id', 'timekeepings.*', 'positions.position_name', 'departments.department')
            ->when(session()->has("timekeeping.name"), function ($q) {
                $q->where("name", "like", "%" . session()->get('timekeeping.name') . "%");
            })
            ->when(session()->has("timekeeping.position"), function ($q) use ($request) {
                $q->where("profile_users.position", session()->get('timekeeping.position'));
            })
            ->when(session()->has("timekeeping.department"), function ($q) use ($request) {
                $q->where('profile_users.department', session()->get('timekeeping.department'));
            })
            ->when(session()->has("timekeeping.month"), function ($q) use ($request) {
                $q->where("timekeeping_month", 'like', session()->get('timekeeping.month') . "%");
            })
            ->orderByDesc('timekeeping_month')
            ->orderBy('users.id')
            ->select('timekeepings.user_id', 'users.name', 'positions.position_name', 'departments.department', 'timekeeping_month', 'timekeeping_code', 'day_off', 'working_days', 'arrive_late', 'hours_late', 'leave_early', 'hours_early', 'timekeepings.created_at')
            ->get();
        return $timekeeping;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [

            ["Stt", "Tên nhân sự", "Chức vụ", "Phòng ban", "Tháng công", "mã chấm công", "Số ngày công", "số ngày nghỉ", "Số lần đi muộn", "Số giờ đi muộn", "Số lần về sớm", "Số giờ về sớm", "Thời gian tạo"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getFont()->setSize(14);
        $sheet->getStyle('A1:L1')->getBorders()->getBottom();
        $cellRange = 'A1:M1';
        $color = 'c4c1c0';
        $sheet->getStyle($cellRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB($color);
    }

    public function map($timekeeping): array
    {
        return [
            $timekeeping->user_id,
            $timekeeping->name,
            $timekeeping->position_name,
            $timekeeping->department,
            $timekeeping->timekeeping_month,
            $timekeeping->timekeeping_code,
            $timekeeping->working_days,
            $timekeeping->day_off,
            $timekeeping->arrive_late,
            $timekeeping->hours_late,
            $timekeeping->leave_early,
            $timekeeping->hours_early,
            $timekeeping->created_at,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => '0.0',
            'H' => '0.0',
            'I' => '0.0',
            'J' => '0.0',
            'K' => '0.0',
            'L' => '0.0',
        ];
    }
}
