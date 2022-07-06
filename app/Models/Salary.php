<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salarys';

    protected static function getAll()
    {
        $salarys = DB::table('salarys')
            ->join('users', 'salarys.user_id', '=', 'users.id')
            ->join('timekeepings', 'salarys.user_id', '=', 'timekeepings.user_id')
            ->join('payments', 'salarys.payment', '=', 'payments.id')
            ->join('profile_users', 'salarys.user_id', '=', 'profile_users.id')
            ->join('positions', 'profile_users.position', '=', 'positions.id')
            // ->join('coefficients_salarys','positions.id','=', 'coefficients_salarys.position')
            // ->join('income_taxs','positions.id','=', 'income_taxs.position')
            ->select(
                'users.name',
                'salarys.*',
                'timekeepings.working_days',
                'payments.payment',
                'profile_users.position',
                'positions.position_name',
                // 'coefficients_salarys.coefficients_salary',
                // 'income_taxs.income_tax'
            )
            ->get();
        return $salarys;
    }

    protected static function getOne($id)
    {
        $salarys = DB::table('salarys')
            ->join('users', 'salarys.user_id', '=', 'users.id')
            ->join('timekeepings', 'salarys.user_id', '=', 'timekeepings.user_id')
            ->join('payments', 'salarys.payment', '=', 'payments.id')
            ->join('profile_users', 'salarys.user_id', '=', 'profile_users.id')
            ->join('positions', 'profile_users.position', '=', 'positions.id')
            ->join('departments', 'profile_users.department', '=', 'departments.id')
            ->join('coefficients_salarys', 'positions.id', '=', 'coefficients_salarys.position')
            ->join('income_taxs', 'positions.id', '=', 'income_taxs.position')
            ->where('salarys.user_id', '=', $id)
            ->select(
                'users.*',
                'salarys.*',
                'timekeepings.working_days',
                'payments.payment',
                'profile_users.position',
                'positions.position_name',
                'departments.department',
                'coefficients_salarys.coefficients_salary',
                'income_taxs.income_tax'
            )
            ->get();
        return $salarys;
    }

    protected static function getRad($id)
    {
        $rads = DB::table('reward_and_disciplines')
            ->join('genre', 'reward_and_disciplines.type', '=', 'genre.id')
            ->where('reward_and_disciplines.user_id', '=', $id)
            ->select('reward_and_disciplines.*', 'genre.genre')
            ->get();
        return $rads;
    }
}
