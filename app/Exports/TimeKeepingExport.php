<?php

namespace App\Exports;

use App\Models\Timekeeping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimeKeepingExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithMapping, WithColumnFormatting, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $request = session('timekeeping');
        $timekeeping = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', '=', 'users.id')
            ->join('profile_users', 'timekeepings.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->join('gender', 'profile_users.gender', 'gender.id')
            ->whereNull('timekeepings.deleted_at')
            ->whereNull('profile_users.deleted_at')
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
            ->select('timekeepings.user_id', 'users.name', 'gender.gender', 'positions.position_name', 'departments.department', 'timekeeping_month', 'timekeeping_code', 'day_off', 'working_days', 'arrive_late', 'hours_late', 'leave_early', 'hours_early')
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
            ["Stt", "Id", "Tên nhân sự",'Giới tính', "Chức vụ", "Phòng ban", "Tháng công", "mã chấm công", "Số công", "số ngày nghỉ", "Số lần đi muộn", "Số giờ đi muộn", "Số lần về sớm", "Số giờ về sớm"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getFont()->setSize(18);
        $sheet->getStyle('2')->getFont()->setBold(true);
        $sheet->getStyle('2')->getFont()->setSize(14);


        $sheet->getStyle('A2:N2')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('c4c1c0');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A:N')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->mergeCells('A1:N1');
                $event->sheet->getDelegate()->getStyle('C2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->freezePane('A3');
            },
        ];
    }

    public function map($timekeeping): array
    {
        return [
            $timekeeping->stt,
            $timekeeping->user_id,
            $timekeeping->name,
            $timekeeping->gender,
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
            'I' => '0.0',
            'J' => '0.0',
            'K' => '0.0',
            'L' => '0.0',
            'M' => '0.0',
            'N' => '0.0',
        ];
    }
}
