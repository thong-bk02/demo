<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaskList extends Model
{
    use HasFactory;

    protected $table = 'task_lists';

    protected static function getAll(){
        $projects = DB::table('task_lists')
            ->join('projects', 'task_lists.project_id', '=', 'projects.id')
            ->join('users', 'task_lists.user_id', '=', 'users.id')
            ->select('task_lists.*', 'projects.project_name', 'users.name')
            ->get();
        return $projects;
    }
}
