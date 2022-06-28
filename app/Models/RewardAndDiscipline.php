<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RewardAndDiscipline extends Model
{
    use HasFactory;

    protected static function getAll()
    {
        $rads = DB::table('reward_and_disciplines')
            ->join('users', 'reward_and_disciplines.user_id', '=', 'users.id')
            ->join('genre','reward_and_disciplines.type', '=', 'genre.id')
            ->select('users.name', 'reward_and_disciplines.*','genre.genre')
            ->orderBy('id')
            ->get();
        return $rads;
    }
}
