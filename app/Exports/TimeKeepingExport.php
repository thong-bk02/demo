<?php

namespace App\Exports;

use App\Models\Timekeeping;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TimeKeepingExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles, WithMapping, WithColumnFormatting
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
            ->select('users.name', 'timekeepings.*', 'positions.position_name', 'departments.department')
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
            ->orderBy('name')
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

            ["Stt", "T??n nh??n s???", "Ch???c v???", "Ph??ng ban", "Th??ng c??ng", "m?? ch???m c??ng", "S??? ng??y c??ng", "s??? ng??y ngh???", "S??? l???n ??i mu???n", "S??? gi??? ??i mu???n", "S??? l???n v??? s???m", "S??? gi??? v??? s???m", "Th???i gian t???o"]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('1')->getFont()->setBold(true)->setSize(18);
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->getStyle('1')->getFont()->setSize(14);
        $sheet->getStyle('A1:L1')->getBorders()->getBottom();
        $cellRange = 'A1:K1';
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
            'G' => '0.00',
            'H' => '0.00',
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => '0.00',
            'K' => '0.00',
            'L' => '0.00',
        ];
    }
}
