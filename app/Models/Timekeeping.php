<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timekeeping extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_date',
        'to_date',
        'working_days',
        'arrive_late',
        'hours_late',
        'leave_early',
        'hours_early'
    ];

    protected static function getAll($request){
        try {
            $timekeepings = DB::table('timekeepings')
            ->join('users', 'timekeepings.user_id', '=', 'users.id')
            ->select('users.*', 'timekeepings.*')
                ->when($request->has("name"), function ($q) use ($request) {
                    $q->where("name", "like", "%" . $request->get("name") . "%");
                });
                // ->when($request->get('date'), function ($q) use ($request) {
                //     $q->where("date", $request->get("date"));
                // });
            return $timekeepings->orderBy('name')->paginate(8);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function newTimekeeping($input){
        try {
            Timekeeping::create($input);
            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function fetchOne($id){
        $timekeepings = DB::table('timekeepings')
            ->join('users','timekeepings.user_id', '=', 'users.id')
            ->select('users.name','timekeepings.*')
            ->where('timekeepings.user_id','=',$id)
            ->get();
        return $timekeepings;
    }

    protected static function dlt($id)
    {
        try {
            Timekeeping::where('user_id', $id)->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    protected static function upd($input, $id)
    {
        try {
            Timekeeping::where('id', $id)
                ->update($input);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
