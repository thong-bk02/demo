<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RewardAndDiscipline extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'reward_and_disciplines';

    protected $fillable = [
        'user_id',
        'type',
        'reasion',
        'note',
        'money',
        'date_created',
    ];

    /**
     *  lấy dánh sách thưởng phạt theo từ khóa tìm kiếm (hoặc không)
     */
    protected static function indexSearch($request)
    {
        try {
            $reward_and_disciplines = DB::table('reward_and_disciplines')
                ->join('users', 'reward_and_disciplines.user_id', 'users.id')
                ->join('profile_users', 'reward_and_disciplines.user_id', 'profile_users.user_id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('genre', 'reward_and_disciplines.type', 'genre.id')
                ->join('gender', 'profile_users.gender', 'gender.id')
                ->select('users.*', 'reward_and_disciplines.*', 'gender.gender', 'genre.genre', 'positions.position_name', 'departments.department')
                ->whereNull('users.deleted_at')
                ->whereNull('reward_and_disciplines.deleted_at')
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

            return $reward_and_disciplines->orderBy('name')->orderBy('date_created', 'desc')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     *  lấy danh sách người dùng để quản lý chọn
     */
    protected static function listSearch($request)
    {
        try {
            $users = DB::table('profile_users')
                ->join('users', 'profile_users.user_id', 'users.id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('gender', 'profile_users.gender', 'gender.id')
                ->select('users.*', 'profile_users.*', 'gender.gender', 'positions.position_name', 'departments.department')
                ->whereNull('profile_users.deleted_at')
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
     * lấy dữ liệu cho form tạo thưởng phạt
     */
    protected static function createUser($id)
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
            // dd($users);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * lấy thông tin về quyết định thưởng phạt
     */
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

    /**
     * thêm thông tin thưởng phạt vào DB
     */
    protected static function createRAD($data)
    {
        try {
            RewardAndDiscipline::create($data);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * xóa thông tin thưởng phạt
     */
    protected static function dlt($id)
    {
        try {
            RewardAndDiscipline::find($id)->delete();
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * cập nhật thông tin thưởng phạt
     */
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

    /**
     * lấy danh sách các quyết định đã xóa
     */
    protected static function deletedDecision($request){
        try {
            $reward_and_disciplines = RewardAndDiscipline::onlyTrashed()
                ->join('users', 'reward_and_disciplines.user_id', 'users.id')
                ->join('profile_users', 'reward_and_disciplines.user_id', 'profile_users.user_id')
                ->join('positions', 'profile_users.position', 'positions.id')
                ->join('departments', 'profile_users.department', 'departments.id')
                ->join('genre', 'reward_and_disciplines.type', 'genre.id')
                ->join('gender', 'profile_users.gender', 'gender.id')
                ->whereNull('profile_users.deleted_at')
                ->select('users.*', 'reward_and_disciplines.*', 'gender.gender', 'genre.genre', 'positions.position_name', 'departments.department')
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

            return $reward_and_disciplines->orderBy('reward_and_disciplines.deleted_at', 'desc')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * khôi phục lại quyết định
     */
    protected static function restoreDecision($id){
        try {
            RewardAndDiscipline::onlyTrashed()->where('id', $id)->restore();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
