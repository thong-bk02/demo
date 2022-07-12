<?php

namespace App\Models;

use Exception;
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
}
