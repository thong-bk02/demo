<?php

namespace App\Http\Controllers;

use App\Models\RewardAndDiscipline;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->clearSession(10);
        /* 
            DATA BẢNG THỐNG KÊ LƯƠNG
        */
        // data line tiền lương trung bình
        $avg_salary = Salary::select(DB::raw("AVG(total_money) as avg"), DB::raw("MONTHNAME(month) as month_name"))
            ->whereYear('month', date('Y'))
            ->groupBy(DB::raw("Month(month)"))
            ->pluck('avg', 'month_name');
        $labels = $avg_salary->keys();
        $data_avg_salary = $avg_salary->values();

        // data tiền lương cao nhất
        $max_salary = Salary::select(DB::raw("MAX(total_money) as max"), DB::raw("MONTHNAME(month) as month_name"))
            ->whereYear('month', date('Y'))
            ->groupBy(DB::raw("Month(month)"))
            ->pluck('max', 'month_name');
        $data_max_salary = $max_salary->values();

        // data tiền lương thấp nhất
        $min_salary = Salary::select(DB::raw("Min(total_money) as min"), DB::raw("MONTHNAME(month) as month_name"))
            ->whereYear('month', date('Y'))
            ->groupBy(DB::raw("Month(month)"))
            ->pluck('min', 'month_name');
        $data_min_salary = $min_salary->values();

        /*  
            DATA BẢNG THỐNG KÊ NHÂN SỰ
        */
        $data_users = DB::table('users')->where('status', '1')->count();
        $quit = DB::table('users')->where('status', '2')->count();
        $staff = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->where('status', 1)
            ->where('position', 1)
            ->count();
        $manager = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->where('status', 1)
            ->where('position', 2)
            ->count();
        $chief_of_department = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->where('status', 1)
            ->whereBetween('position', [3, 5])
            ->count();

        /* 
            DATA BẢNG THỐNG KÊ THƯỞNG PHẠT
        */
        $decision = RewardAndDiscipline::select(DB::raw("COUNT(id) as reward"), DB::raw("MONTHNAME(date_created) as month_name"))
            ->whereYear('date_created', date('Y'))
            ->groupBy(DB::raw("Month(date_created)"))
            ->pluck('reward', 'month_name');
        $labels_decision = $decision->keys();
        $reward = RewardAndDiscipline::select(DB::raw("COUNT(id) as reward"), DB::raw("MONTHNAME(date_created) as month_name"))
            ->whereYear('date_created', date('Y'))
            ->groupBy(DB::raw("Month(date_created)"))->where('type', 2)
            ->pluck('reward', 'month_name')
            ->values();
        $discipline = RewardAndDiscipline::select(DB::raw("COUNT(id) as discipline"), DB::raw("MONTHNAME(date_created) as month_name"))
            ->whereYear('date_created', date('Y'))
            ->groupBy(DB::raw("Month(date_created)"))->where('type', 1)
            ->pluck('discipline', 'month_name')
            ->values();
        // dd($reward);
        $furlough =  RewardAndDiscipline::where('reasion', 1)->count();
        $salary_deduction = RewardAndDiscipline::where('reasion', 2)->count();
        $late = RewardAndDiscipline::where('reasion', 3)->count();
        $soon = RewardAndDiscipline::where('reasion', 4)->count();
        $go_out = RewardAndDiscipline::where('reasion', 5)->count();
        $homemade = RewardAndDiscipline::where('reasion', 7)->count();


        return view('home', compact(
            'labels',
            'data_avg_salary',
            'data_max_salary',
            'data_min_salary',
            'data_users',
            'staff',
            'manager',
            'chief_of_department',
            'quit',
            'labels_decision',
            'reward',
            'discipline',
            'furlough',
            'salary_deduction',
            'late',
            'soon',
            'go_out',
            'homemade',
        ));
    }

    public function main(){
        if(Auth::user()->admin == 1){
            return redirect()->route('home');
        }
        return redirect()->route('users');
    }
}
