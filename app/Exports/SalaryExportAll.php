<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SalaryExportAll implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
