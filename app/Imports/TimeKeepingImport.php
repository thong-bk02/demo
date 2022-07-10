<?php

namespace App\Imports;

use App\Models\Timekeeping;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TimeKeepingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Timekeeping([
            'id'     => $row['id'],
            'user_id'    => $row['id_nhan_su'], 
            'from_date'     => $row['ngay_bat_dau'],
            'to_date'     => $row['ngay_hien_tai'],
            'working_days'     => $row['so_ngay_cong'],
            'arrive_late'     => $row['so_lan_di_muon'],
            'hours_late'     => $row['so_gio_di_muon'],
            'leave_early'     => $row['so_lan_ve_som'],
            'hours_early'     => $row['so_gio_ve_som'],
        ]);
    }
    
}
