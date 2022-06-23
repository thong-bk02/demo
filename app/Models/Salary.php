<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salary extends Model
{
    use HasFactory;

    protected static function getAll(){
        $salarys = DB::table('salarys')
        ->join('users', 'salarys.user-id', '=', 'users.id')
        ->join('payments','salarys.payment', '=', 'payments.id')
        ->join('income_taxs','salarys.income_tax', '=', 'income_taxs.id')
        ->select('users.name', 'projects.*')
        ->get();
    return $salarys;
    }
}
