<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
// use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalaryExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithMapping, WithColumnFormatting, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $salary = DB::table('salary')
            ->join('users', 'salary.user_id', 'users.id')
            ->join('profile_users', 'salary.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->join('gender', 'profile_users.gender', 'gender.id')
            ->join('payments', 'salary.payment', 'payments.id')
            ->join('basic_salary', 'basic_salary.id', 'salary.basic_salary')
            ->whereNull('profile_users.deleted_at')
            ->whereNull('salary.deleted_at')
            ->when(session()->has("salary.name"), function ($q) {
                $q->where("name", "like", "%" . session()->get('salary.name') . "%");
            })
            ->when(session()->has("salary.position"), function ($q)  {
                $q->where("profile_users.position", session()->get('salary.position'));
            })
            ->when(session()->has("salary.department"), function ($q)  {
                $q->where('profile_users.department', session()->get('salary.department'));
            })
            ->when(session()->has("salary.month"), function ($q)  {
                $q->where("month", 'like', session()->get('salary.month') . "%");
            })
            ->orderBy('salary.user_id')
            ->orderByDesc('month')
            ->select(
                'users.name',
                'positions.position_name',
                'departments.department',
                'gender.gender',
                'salary.*',
                'basic_salary.basic_salary',
                'payments.payment',
            )
            ->get();
        $row = 1;
        foreach ($salary as $value) {
            $value->stt = $row;
            $row++;
        };
        return $salary;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return [
            ['Thông tin Lương'],
            ["Stt", "Tên nhân sự",'Giới tính', "Chức vụ", "Phòng ban", "Tháng lương", "Mã lương", "Lương cơ bản", "Trợ cấp", "Tổng tiền thưởng", "Tổng tiền phạt", "Thuế thu nhập", "Tiền lương", "Phương thức thanh toán", "Ngày thanh toán"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getFont()->setSize(18);
        $sheet->getStyle('2')->getFont()->setBold(true);
        $sheet->getStyle('2')->getFont()->setSize(14);


        $sheet->getStyle('A2:O2')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('c4c1c0');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A:O')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle('C')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $event->sheet->mergeCells('A1:O1');
                $event->sheet->getDelegate()->getStyle('C2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->freezePane('A3');
            },
        ];
    }

    public function map($salary): array
    {
        return [
            $salary->stt,
            $salary->name,
            $salary->gender,
            $salary->position_name,
            $salary->department,
            date('m-Y', strtotime($salary->month)),
            $salary->salary_code,
            $salary->basic_salary,
            $salary->subsidize,
            $salary->total_reward,
            $salary->total_discipline,
            $salary->income_tax,
            $salary->total_money,
            $salary->payment,
            $salary->date_of_payment,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => '#,#0.0_-"VNĐ"',
            'I' => '#,#0.0_-"VNĐ"',
            'J' => '#,#0.0_-"VNĐ"',
            'K' => '#,#0.0_-"VNĐ"',
            'L' => '#,#0.0_-"%"',
            'M' => '#,#0.0_-"VNĐ"',
        ];
    }
}
