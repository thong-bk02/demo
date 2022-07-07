<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
    protected static function search($request)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->select('users.*', 'profile_users.*', 'positions.position_name', 'departments.department')
                ->where('name', '<>', Auth::user()->name)
                ->when($request->has("name"), function ($q) use ($request) {
                    $q->where("name", "like", "%" . $request->get("name") . "%");
                })
                ->when($request->get('position'), function ($q) use ($request) {
                    $q->where("profile_users.position", $request->get("position"));
                })
                ->when($request->get('department'), function ($q) use ($request) {
                    $q->where('profile_users.department', $request->get('department'));
                })
                ->when($request->get('status'), function ($q) use ($request) {
                    $q->where('users.status', $request->get('status'));
                });
            return $users->orderBy('name')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

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
        }
    }
}
