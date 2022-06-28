<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile_users';

    protected static function getProfile($id){
        $profile = DB::table('profile_users')
        ->where('user_id','=',$id)->get();
        return $profile;
    }
}
