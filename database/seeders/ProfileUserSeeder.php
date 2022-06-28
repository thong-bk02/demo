<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_users')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'user_code' => "qn11",
                'address' => "address 1",
                'phone' => '123123123',
                'birthday' => date('Y-m-d'),
                'position' => '6',
                'department' => '1',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'user_id' => 2,
                'user_code' => "tn22",
                'address' => "address 2",
                'phone' => '1313131212',
                'birthday' => date('Y-m-d'),
                'position' => '2',
                'department' => '2',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'user_id' => 3,
                'user_code' => "hg33",
                'address' => "address 2",
                'phone' => '111222333',
                'birthday' => date('Y-m-d'),
                'position' => '3',
                'department' => '3',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'user_id' => 4,
                'user_code' => "vu44",
                'address' => "address 4",
                'phone' => '234234234',
                'birthday' => date('Y-m-d'),
                'position' => '4',
                'department' => '4',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
