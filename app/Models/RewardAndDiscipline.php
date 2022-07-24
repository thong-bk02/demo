<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardAndDiscipline extends Model
{
    use HasFactory;

    protected $table = 'reward_and_disciplines';

    protected $fillable = [
        'user_id',
        'type',
        'reasion',
        'note',
        'money',
        'date_created',
    ];

    protected static function indexSearch($request)
    {
        try {
            $reward_and_disciplines = DB::table('reward_and_disciplines')
                ->join('users', 'reward_and_disciplines.user_id', 'users.id')
                ->join('profile_users', 'reward_and_disciplines.user_id', 'profile_users.user_id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('genre', 'reward_and_disciplines.type', 'genre.id')
                ->select('users.name', 'reward_and_disciplines.*', 'genre.genre', 'positions.position_name', 'departments.department')
                ->when($request->has("name"), function ($q) use ($request) {
                    $q->where("name", "like", "%" . $request->get("name") . "%");
                })
                ->when($request->get('position'), function ($q) use ($request) {
                    $q->where("profile_users.position", $request->get("position"));
                })
                ->when($request->get('department'), function ($q) use ($request) {
                    $q->where('profile_users.department', $request->get('department'));
                })
                ->when($request->get('date_created'), function ($q) use ($request) {
                    $q->where('date_created', $request->get('date_created'));
                });

            return $reward_and_disciplines->orderBy('date_created', 'desc')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function listSearch($request)
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
                });

            return $users->orderBy('name')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function createUser($id)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->select('users.name', 'profile_users.*', 'positions.position_name', 'departments.department')
                ->where('profile_users.user_id', $id)
                ->get();
            return $users;
            // dd($users);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function showRAD($id)
    {
        try {
            $decision = DB::table('reward_and_disciplines')
                ->join('users', 'reward_and_disciplines.user_id', 'users.id')
                ->join('profile_users', 'reward_and_disciplines.user_id', 'profile_users.user_id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('genre', 'reward_and_disciplines.type', 'genre.id')
                ->join('reasion', 'reasion.id', 'reward_and_disciplines.reasion')
                ->select('users.name', 'reward_and_disciplines.*', 'genre.genre', 'positions.position_name', 'departments.*')
                ->where('reward_and_disciplines.id', $id)
                ->get();
            return $decision;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function createRAD($data)
    {
        try {
            RewardAndDiscipline::create($data);
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    protected static function deleteDecision($id)
    {
        try {
            RewardAndDiscipline::find($id)->delete();
        } catch (Exception $ex) {
            return false;
        }
    }

    protected static function upd($request, $id)
    {
        try {
            RewardAndDiscipline::where('user_id', $id)
                ->update($request);
            DB::commit();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
