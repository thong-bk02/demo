<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // lấy dữ liệu tìm kiếm cho trang quản lí tài khoản
    protected static function search($request)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('gender', 'profile_users.gender', 'gender.id')
                ->select('users.*', 'profile_users.*', 'gender.gender', 'positions.position_name', 'departments.department')
                ->whereNull('users.deleted_at')
                ->where('name', '<>', Auth::user()->name)
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

    // cập nhật quyền truy cập (1: là admin / 0: là người dùng)
    protected static function access($id, $admin)
    {
        if ($admin == 1) {
            User::where('id', $id)
                ->update(['admin' => 0]);
        } else {
            User::where('id', $id)
                ->update(['admin' => 1]);
        }
    }

    // cập nhật trạng thái hoạt động (1: là hoạt động / 2: không hoạt động)
    protected static function status($id, $status)
    {
        if ($status == 1) {
            User::where('id', $id)
                ->update(['status' => 2]);
        } else {
            User::where('id', $id)
                ->update(['status' => 1]);
        }
    }

    // lấy thông tin người dùng có id = $id
    protected static function getUser($id)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->select('users.*', 'profile_users.*')
                ->where('profile_users.user_id', $id)
                ->get();
            return $users;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    // cập nhật thông tin người dùng có id = $id
    protected static function upd($user, $profile, $id)
    {
        DB::beginTransaction();
        try {
            User::where('id', $id)
                ->update($user);
            ProfileUser::where('user_id', $id)
                ->update($profile);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    // tìm kiếm nhân sự


    // tạo nhân sự mới
    protected static function newUser($user, $profile)
    {
        DB::beginTransaction();
        try {
            $id = User::create($user)->id;
            $profile['user_id'] = $id;
            $profile['user_code'] = (string)$id . "-" . $profile['position'] . "-" . $profile['department'];
            ProfileUser::create($profile);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    // xóa nhân sự -
    protected static function dlt($id)
    {
        DB::beginTransaction();
        try {
            ProfileUser::where('user_id', $id)->delete();
            User::find($id)->delete();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * lấy danh sách nhân sự đã nghỉ việc
     */
    protected static function deletedAccount($request)
    {
        try {
            $users = ProfileUser::onlyTrashed()
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('gender', 'profile_users.gender', 'gender.id')
                ->select('users.*', 'profile_users.*', 'gender.gender', 'positions.position_name', 'departments.department')
                ->where('name', '<>', Auth::user()->name)
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

    /**
     * khôi phục tài khoản
     */
    protected static function restoreUser($user_id){
        DB::beginTransaction();
        try {
            ProfileUser::onlyTrashed()->where('user_id', $user_id)->restore();
            User::onlyTrashed()->where('id', $user_id)->restore();
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
