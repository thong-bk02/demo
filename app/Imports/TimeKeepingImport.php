<?php

namespace App\Imports;

use App\Models\Timekeeping;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class TimekeepingImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        try {
            DB::beginTransaction();
            foreach ($rows as $row) {
                $month = Str::substr($row['thang_cong'],-4).'-'.Str::substr($row['thang_cong'], 0, 2).'-01';
                $data = [
                    'user_id'           => $row['id_nhan_su'],
                    'timekeeping_code'  => $row['ma_cham_cong'],
                    'timekeeping_month' => $month,
                    'day_off'           => $row['so_ngay_nghi'],
                    'working_days'      => $row['so_cong'],
                    'arrive_late'       => $row['so_lan_di_muon'],
                    'hours_late'        => $row['so_gio_di_muon'],
                    'leave_early'       => $row['so_lan_ve_som'],
                    'hours_early'       => $row['so_gio_ve_som'],
                ];
                // dd($month);
                Timekeeping::create($data);
            }
            DB::commit();
            return redirect()->back()->with('success', 'import dữ liệu thành công');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'import dữ liệu không thành công !');
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}
