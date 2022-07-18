<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salary';

    protected $fillable = [
        'user_id',
        'timekeeping',
        'coefficients_salary',
        'subsidize',
        'total_reward',
        'total_discipline',
        'total_money',
        'income_tax',
        'payment',
        'month',
    ];

    protected static function getAll()
    {
        $salarys = DB::table('salary')
            ->join('users', 'salary.user_id', 'users.id')
            ->join('timekeepings', 'salary.user_id', 'timekeepings.user_id')
            ->join('payments', 'salary.payment', 'payments.id')
            ->join('profile_users', 'salary.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            // ->join('coefficients_salarys','positions.id','=', 'coefficients_salarys.position')
            // ->join('income_taxs','positions.id','=', 'income_taxs.position')
            ->select(
                'users.name',
                'salary.*',
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
        $salarys = DB::table('salary')
            ->join('users', 'salary.user_id', 'users.id')
            ->join('timekeepings', 'salary.user_id', 'timekeepings.user_id')
            ->join('profile_users', 'salary.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->join('coefficients_salarys', 'positions.id', 'coefficients_salarys.position')
            ->join('income_taxs', 'positions.id', 'income_taxs.position')
            ->where('salary.user_id', $id)
            ->select(
                'users.*',
                'salary.*',
                'timekeepings.working_days',
                'profile_users.position',
                'positions.position_name',
                'departments.department',
                'coefficients_salarys.coefficients_salary',
                'income_taxs.income_tax'
            )
            ->get();

        return $salarys;
    }

    protected static function getDecision($id)
    {
        $decision = DB::table('reward_and_disciplines')
            ->join('genre', 'reward_and_disciplines.type', 'genre.id')
            ->where('reward_and_disciplines.user_id', $id)
            ->select('reward_and_disciplines.*', 'genre.genre')
            ->orderByDesc('created_at')
            ->get();
        return $decision;
    }

    protected static function get_Total_RewardAndDiscipline($id, $type)
    {
        $reward = DB::table('reward_and_disciplines')
            ->join('genre', 'reward_and_disciplines.type', 'genre.id')
            ->where('reward_and_disciplines.user_id', $id)
            ->where('type', $type)
            ->sum('money');
        return $reward;
    }

    protected static function listSearch($request)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->select('users.*', 'profile_users.*', 'positions.position_name', 'departments.department')
                ->when($request->has("name"), function ($q) use ($request) {
                    $q->where("name", "like", "%" . $request->get("name") . "%");
                })
                ->when($request->get('position'), function ($q) use ($request) {
                    $q->where("profile_users.position", $request->get("position"));
                })
                ->when($request->get('department'), function ($q) use ($request) {
                    $q->where('profile_users.department', $request->get('department'));
                });

            return $users->orderBy('name')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function getSalary($id)
    {
        $salarys = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->join('timekeepings', 'profile_users.user_id', 'timekeepings.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->join('coefficients_salarys', 'positions.id', 'coefficients_salarys.position')
            ->where('profile_users.user_id', $id)
            ->select(
                'users.name',
                'profile_users.user_id',
                'timekeepings.working_days',
                'timekeepings.id',
                'profile_users.position',
                'positions.position_name',
                'departments.department',
                'coefficients_salarys.coefficients_salary',
            )
            ->get();

        return $salarys;
    }

    protected static function createdSalary($input)
    {
        try {
            Salary::create($input);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
 