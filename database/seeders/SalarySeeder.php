<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salarys')->insert([
            [
                'id' => 1,
                'user_id' => "quỳnh",
                'email' => "quynh@gmail.com",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'name' => "tuấn",
                'email' => "tuan@gmail.com",
                'status' => 1,
                'password' => "",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'name' => "hoàng",
                'email' => "hoang@gmail.com",
                'status' => 1,
                'password' => "",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'name' => "vũ",
                'email' => "vu@gmail.com",
                'status' => 1,
                'password' => "",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
