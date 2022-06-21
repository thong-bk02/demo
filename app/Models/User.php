<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'power',
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

    protected static function getAll()
    {
        $users = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', '=', 'users.id')
            ->join('positions', 'profile_users.position', '=', 'positions.id')
            ->join('departments', 'profile_users.department', '=', 'departments.id')
            ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
            ->get();
        return $users;
    }

    protected static function getUser($id)
    {
        $users = DB::table('profile_users')
            ->join('users', 'profile_users.user_id', '=', 'users.id')
            ->join('positions', 'profile_users.position', '=', 'positions.id')
            ->join('departments', 'profile_users.department', '=', 'departments.id')
            ->select('users.*', 'profile_users.*', 'positions.*', 'departments.*')
            ->where('users.id', '=', $id)
            ->get();
        return $users;
    }

    protected static function upd($user, $profile, $id){
        User::updated($user);
        ProfileUser::updated($profile);
    }
}
