<?php

namespace App\Models;

use Exception;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    // lấy danh sách người dùng có status = 1 (1: hoạt động/ 2: không hoạt động)
    protected static function getAll()
    {
        $users = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->join('positions', 'profile_users.position', 'positions.id')
            ->join('departments', 'profile_users.department', 'departments.id')
            ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
            ->where('users.status', 1)
            ->orderBy('user_id')
            ->paginate(10);

        return $users;
    }

    // lấy thông tin người dùng có id = $id
    protected static function getUser($id)
    {
        $users = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', 'users.id')
            ->select('users.*', 'profile_users.*')
            ->where('profile_users.user_id', $id)
            ->get();
        return $users;
    }

    // cập nhật thông tin người dùng có id = $id
    protected static function upd($user, $profile, $id)
    {
        try {
            User::where('id', $id)
                ->update($user);
            ProfileUser::where('user_id', $id)
                ->update($profile);
            return true;
        } catch (Exception $ex) {
            // return false;
            throw $ex;
        }
    }

    // tìm kiếm
    protected static function search($name, $position, $department)
    {
        try {
            if (empty($name) & $position == 0 & $department == 0) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;

            } else if (empty($name) & $position == 0) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->Where('profile_users.department',$department)
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            } else if (empty($name) & $department == 0) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->Where('profile_users.position', $position)
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            } else if ($position == 0 & $department == 0) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->where('users.name', 'like', '%' . $name . '%')
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            } else if (empty($name)) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->Where('profile_users.position', $position)
                    ->Where('profile_users.department', $department)
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            } else if ($position == 0) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->where('users.name', 'like', '%' . $name . '%')
                    ->Where('profile_users.department', $department)
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            } else if ($department == 0) {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->where('users.name', 'like', '%' . $name . '%')
                    ->Where('profile_users.position', $position)
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            } else {
                $users = DB::table('profile_users')
                    ->join('users', 'profile_users.user_id', 'users.id')
                    ->join('positions', 'profile_users.position', 'positions.id')
                    ->join('departments', 'profile_users.department', 'departments.id')
                    ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
                    ->where('users.name', 'like', '%' . $name . '%')
                    ->Where('profile_users.position', $position)
                    ->Where('profile_users.department', $department)
                    ->orderBy('user_id')
                    ->paginate(10);
                return $users;
            }
        } catch (Exception $ex) {
            throw $ex;
        }


        // try {
        //     $users = DB::table('profile_users')
        //         ->join('users', 'profile_users.user_id', 'users.id')
        //         ->join('positions', 'profile_users.position', 'positions.id')
        //         ->join('departments', 'profile_users.department', 'departments.id')
        //         ->select('users.*', 'profile_users.*', 'positions.position_name', 'departments.department');

        //     if (empty($name) & $position == 0 & $department == 0) {
        //     } else if (empty($name) & $position == 0) {
        //         $users->Where('profile_users.department', $department);
        //     } else if (empty($name) & $department == 0) {
        //         $users->Where('profile_users.position', $position);
        //     } else if ($position == 0 & $department == 0) {
        //         $users->where('users.name', 'like', $name);
        //     } else if (empty($name)) {
        //         $users->Where([
        //             ['profile_users.position', $position],
        //             ['profile_users.department', $department]
        //         ]);
        //     } else if ($position == 0) {
        //         $users->where([
        //             ['users.name', 'like', $name],
        //             ['profile_users.department', $department]
        //         ]);
        //     } else if ($department == 0) {
        //         $users->where([
        //             ['users.name', 'like', $name],
        //             ['profile_users.position', $position]
        //         ]);
        //     } else {
        //         $users->where([
        //             ['users.name', 'like', '%' . $name . '%'],
        //             ['profile_users.position', $position],
        //             ['profile_users.department', $department]
        //         ]);
        //     }
        //     $users->orderBy('user_id')->paginate(10);
        //     return $users;
        // } catch (Exception $ex) {
        //     throw $ex;
        // }
    }

    // tạo nhân sự mới
    protected static function newUser($user, $profile)
    {
        DB::beginTransaction();
        try {
            $id = User::create($user)->id;
            $profile['user_id'] = $id;
            $profile['user_code'] = (string)$id ."-" . $profile['position'] ."-" . $profile['department'] ;
            ProfileUser::create($profile);
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    // xóa nhân sự bằng cách set status
    protected static function dlt($id)
    {
        User::where('id', $id)
            ->update(['status' => 0]);
    }
}
