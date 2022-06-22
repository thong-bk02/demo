<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('task_lists')->insert([
            [
                'id' => 1,
                'project_id' => 1,
                'title' => 'title task 1',
                'content' => 'content task 1',
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'progress' => 50,
                'user_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'project_id' => 1,
                'title' => 'title task 2',
                'content' => 'content task 2',
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'progress' => 60,
                'user_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'project_id' => 2,
                'title' => 'title task 1',
                'content' => 'content task 1',
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'progress' => 70,
                'user_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'project_id' => 2,
                'title' => 'title task 2',
                'content' => 'content task 2',
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'progress' => 80,
                'user_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
