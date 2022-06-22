<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'id' => 1,
                'project_name' => "project1",
                'project_manager' => 1,
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'project_name' => "project2",
                'project_manager' => 2,
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'project_name' => "project3",
                'project_manager' => 3,
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'project_name' => "project4",
                'project_manager' => 4,
                'start_date' => date('Y-m-d'),
                'intend_time' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
