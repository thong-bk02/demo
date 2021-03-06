<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Salary extends Model
{
    use HasFactory;

    protected $table = 'salary';

    protected $fillable = [
        'user_id',
        'salary_code',
        'timekeeping',
        'coefficients_salary',
        'subsidize',
        'total_reward',
        'total_discipline',
        'total_money',
        'income_tax',
        'payment',
        'date_of_payment',
        'month',
    ];

    /* 
        lấy danh sách lương
    */
    protected static function getAll($request)
    {
        $salarys = DB::table('salary')
            ->join('users', 'salary.user_id', 'users.id')
            ->join('payments', 'salary.payment', 'payments.id')
            ->join('profile_users', 'salary.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->select(
                'users.name',
                'salary.*',
                'payments.payment',
                'profile_users.position',
                'positions.position_name',
            )
            ->when($request->has("name"), function ($q) use ($request) {
                $q->where("name", "like", "%" . $request->get("name") . "%");
            })
            ->when($request->get('position'), function ($q) use ($request) {
                $q->where("profile_users.position", $request->get("position"));
            })
            ->when($request->get('department'), function ($q) use ($request) {
                $q->where('profile_users.department', $request->get('department'));
            })
            ->when($request->get('month'), function ($q) use ($request) {
                $q->where('month', 'like', $request->get('month') . "%");
            });
        return $salarys->orderByDesc('month')->orderBy('name')->paginate(8);
    }

    /* 
        lấy thông tin người dùng có id = $id
    */
    protected static function getOne($salary_code)
    {
        $month = Str::substr($salary_code, -7);
        $salarys = DB::table('salary')
            ->join('users', 'salary.user_id', 'users.id')
            ->join('timekeepings', 'salary.user_id', 'timekeepings.user_id')
            ->join('profile_users', 'salary.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->join('coefficients_salarys', 'positions.id', 'coefficients_salarys.position')
            ->where('salary.salary_code', $salary_code)
            ->where('timekeepings.timekeeping_month', 'like', $month . "%")
            ->select(
                'users.name',
                'salary.*',
                'timekeepings.*',
                'profile_users.position',
                'positions.position_name',
                'departments.department',
                'coefficients_salarys.coefficients_salary'
            )
            ->get();
        // dd($salarys);
        return $salarys;
    }

    /* 
        lấy dánh sách thưởng phạt của nhân sự đang tạo lương  
    */
    protected static function getDecision($id, $month)
    {
        $decision = DB::table('reward_and_disciplines')
            ->join('genre', 'reward_and_disciplines.type', 'genre.id')
            ->join('reasion','reward_and_disciplines.reasion', 'reasion.id')
            ->where('reward_and_disciplines.user_id', $id)
            ->where('reward_and_disciplines.date_created', 'like', $month . "%")
            ->select('reward_and_disciplines.*', 'genre.genre', 'reasion.reasion')
            ->orderByDesc('created_at')
            ->get();
        return $decision;
    }

    /* 
        tính tổng thưởng và tổng phạt
    */
    protected static function get_Total_RewardAndDiscipline($id, $month, $type)
    {
        $reward = DB::table('reward_and_disciplines')
            ->join('genre', 'reward_and_disciplines.type', 'genre.id')
            ->where('reward_and_disciplines.user_id', $id)
            ->when(blank($month), function ($q) use ($month) {
                $q->where('reward_and_disciplines.date_created', $month);
            })
            ->when($month, function ($q) use ($month) {
                $q->where('reward_and_disciplines.date_created', 'like', $month . "%");
            })
            ->where('type', $type)
            ->sum('money');
        return $reward;
    }

    /*
        lấy số ngày công của nhân sự theo tháng
    */
    protected static function getWorkingDays($id, $month)
    {
        $working_days = DB::table('timekeepings')
            ->where('user_id', $id)
            ->where('timekeeping_month', 'like', $month . "%")
            ->select('working_days')
            ->get();
        $day  = data_get($working_days, '0.working_days');
        return $day;
    }


    /* 
        lấy danh sách những nhân sự chưa có lương  
    */
    protected static function listSearch($request)
    {
        try {
            // $salary = DB::table('salary')->select('user_id')->get();
            // $array = json_decode(json_encode($salary), true);
            // $demo = Arr::flatten($array);
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->select('users.*', 'profile_users.*', 'positions.position_name', 'departments.department')
                // ->whereNotIn('profile_users.user_id', $demo)
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

    /* 
        lấy thông tin của người dùng để đưa vào form tạo lương  
    */
    protected static function getSalary($id, $month)
    {
        $salarys = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->join('timekeepings', 'profile_users.user_id', 'timekeepings.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->join('coefficients_salarys', 'positions.id', 'coefficients_salarys.position')
            ->where('profile_users.user_id', $id)
            ->where('timekeepings.timekeeping_month', 'like', $month . "%")
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

    /* 
        tạo lương  
    */
    protected static function createdSalary($input)
    {
        try {
            Salary::create($input);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /* 
        cập nhật lương  
    */
    protected static function updateSalary($input, $id)
    {
        $month = $input['month'];
        try {
            Salary::where('user_id', $id)->where('month', $month)->update($input);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /* 
        xóa lương
    */
    protected static function dlt($salary_code)
    {
        try {
            Salary::where('salary_code', $salary_code)->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
