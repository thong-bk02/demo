<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;

    protected static function getAll(){
        $projects = DB::table('projects')
            ->join('users', 'projects.project_manager', '=', 'users.id')
            ->select('users.*', 'projects.*')
            ->get();
        return $projects;
    }
}
