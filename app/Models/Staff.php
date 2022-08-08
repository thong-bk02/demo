<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{
    use HasFactory;

    protected static function getTimekeeping($request)
    {
        $timekeepings = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', 'users.id')
            ->join('profile_users', 'timekeepings.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->select('users.name', 'timekeepings.*', 'positions.position_name', 'departments.department')
            ->where('timekeepings.user_id', Auth::user()->id)
            ->when($request->get('month'), function ($q) use ($request) {
                $q->where("timekeeping_month", 'like', $request->get("month") . "%");
            })
            ->get();
        return $timekeepings;
    }

    protected static function getUserInfo(){
        $user = DB::table('profile_users')
        ->join('users', 'profile_users.user_id', 'users.id')
        ->join('positions', 'profile_users.position', 'positions.id')
        ->join('departments', 'profile_users.department', 'departments.id')
        ->select('users.name','positions.position_name','departments.department')
        ->where('profile_users.user_id', Auth::user()->id)
        ->get();
        return $user;
    }

    protected static function getDecision($request)
    {
        try {
            $decision = DB::table('reward_and_disciplines')
                ->join('genre', 'reward_and_disciplines.type', 'genre.id')
                ->join('reasion', 'reasion.id', 'reward_and_disciplines.reasion')
                ->select('reward_and_disciplines.*', 'genre.genre', 'reasion.reasion')
                ->where('reward_and_disciplines.user_id', Auth::user()->id)
                ->when($request->get('month'), function ($q) use ($request) {
                    $q->where('date_created', 'like', $request->get('month') . "%");
                });
            return $decision->orderBy('date_created', 'desc')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function getSalary($request)
    {
        try {
            $salarys = DB::table('salary')
                ->join('payments', 'salary.payment', 'payments.id')
                ->join('basic_salary','basic_salary.id', 'salary.basic_salary')
                ->select('salary.*','payments.payment','basic_salary.basic_salary')
                ->where('salary.user_id', Auth::user()->id)
                ->when($request->get('month'), function ($q) use ($request) {
                    $q->where('month', 'like', $request->get('month') . "%");
                })
                ->get();
            return $salarys;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function getAllEvent(){
        $event = DB::table('events')
        ->where('status', 1)
        ->orderByDesc('start_date')->paginate(10);
        return $event;
    }
}
