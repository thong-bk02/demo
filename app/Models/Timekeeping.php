<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Timekeeping extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'user_id',
        'timekeeping_code',
        'timekeeping_month',
        'overtime',
        'day_off',
        'working_days',
        'arrive_late',
        'hours_late',
        'leave_early',
        'hours_early'
    ];

    protected static function getAll($request)
    {
        try {
            $timekeepings = DB::table('timekeepings')
                ->join('users', 'timekeepings.user_id', '=', 'users.id')
                ->join('profile_users', 'timekeepings.user_id', 'profile_users.user_id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->select('users.name', 'timekeepings.*', 'positions.position_name', 'departments.department')
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
                    $q->where("timekeeping_month",'like', $request->get("month"). "%");
                });
            return $timekeepings->orderByDesc('timekeeping_month')->orderBy('name')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // lấy dữ liệu đưa vào form tạo chấm công
    protected static function formCreate($id)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->select('users.name', 'profile_users.user_id', 'positions.position_name', 'departments.department')
                ->where('profile_users.user_id', $id)
                ->get();
            return $users;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // thêm mới record vào table timekeepings
    protected static function createTimekeeping($input)
    {
        try {
            Timekeeping::create($input);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function fetchOne($code)
    {
        $timekeepings = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', 'users.id')
            ->join('profile_users', 'timekeepings.user_id', 'profile_users.user_id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->select('users.name', 'timekeepings.*', 'positions.position_name', 'departments.department')
            ->where('timekeepings.timekeeping_code', $code)
            ->get();
        return $timekeepings;
    }

    protected static function dlt($timekeeping_code)
    {
        try {
            Timekeeping::where('timekeeping_code', $timekeeping_code)->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function upd($input, $code)
    {
        try {
            Timekeeping::where('timekeeping_code', $code)
                ->update($input);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
