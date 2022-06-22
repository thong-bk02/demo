<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Power extends Model
{
    use HasFactory;

    protected static function getAll(){
        $users = DB::table('powers')
            ->join('positions', 'powers.position_id', '=', 'positions.id')
            ->select('powers.*', 'positions.*')
            ->get();
        return $users;
    }
    
}
