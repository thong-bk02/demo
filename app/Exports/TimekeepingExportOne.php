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
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimekeepingExportOne implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithMapping, WithColumnFormatting, WithEvents
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
            ->select('timekeepings.user_id', 'users.name', 'positions.position_name', 'departments.department', 'timekeeping_month', 'timekeeping_code', 'day_off', 'working_days', 'arrive_late', 'hours_late', 'leave_early', 'hours_early', 'timekeepings.created_at')
            ->get();
        $row = 1;
        foreach ($timekeeping as $value) {
            $value->stt = $row;
            $row++;
        };
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
            ['Thông tin chấm công'],
            ["Stt", "Tên nhân sự", "Chức vụ", "Phòng ban", "Tháng công", "mã chấm công", "Số công", "số ngày nghỉ", "Số lần đi muộn", "Số giờ đi muộn", "Số lần về sớm", "Số giờ về sớm"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getFont()->setSize(18);
        $sheet->getStyle('2')->getFont()->setBold(true);
        $sheet->getStyle('2')->getFont()->setSize(14);

        
        $sheet->getStyle('A2:L2')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('c4c1c0');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A:L')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->mergeCells('A1:L1');
                $event->sheet->getDelegate()->getStyle('C2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }

    public function map($timekeeping): array
    {
        return [
            $timekeeping->stt,
            $timekeeping->name,
            $timekeeping->position_name,
            $timekeeping->department,
            date('m-Y', strtotime($timekeeping->timekeeping_month)),
            $timekeeping->timekeeping_code,
            $timekeeping->working_days,
            $timekeeping->day_off,
            $timekeeping->arrive_late,
            $timekeeping->hours_late,
            $timekeeping->leave_early,
            $timekeeping->hours_early,
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
