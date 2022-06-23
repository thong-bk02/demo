<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timekeeping extends Model
{
    use HasFactory;

    protected static function getAll(){
        $timekeeping = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', '=', 'users.id')
            ->select('users.name', 'timekeepings.*')
            ->get();
        return $timekeeping;
    }

    protected static function fetchOne($id){
        $timekeepings = DB::table('timekeepings')
            ->join('users','timekeepings.user_id', '=', 'users.id')
            ->select('users.name','timekeepings.*')
            ->where('timekeepings.user_id','=',$id)
            ->get();
        return $timekeepings;
    }
}
