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
                'user_code' => "01-6-1",
                'gender' => '2',
                'address' => "Hà Nội",
                'phone' => '0393794280',
                'birthday' => date('Y-m-d'),
                'position' => '6',
                'department' => '1',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'user_id' => 2,
                'user_code' => "02-2-2",
                'gender' => '1',
                'address' => "Bắc Ninh",
                'phone' => '0393794281',
                'birthday' => date('Y-m-d'),
                'position' => '2',
                'department' => '2',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'user_id' => 3,
                'user_code' => "03-3-3",
                'gender' => '1',
                'address' => "Hải Phòng",
                'phone' => '0393794282',
                'birthday' => date('Y-m-d'),
                'position' => '3',
                'department' => '3',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'user_id' => 4,
                'user_code' => "04-4-4",
                'gender' => '1',
                'address' => "Lạng Sơn",
                'phone' => '0393794283',
                'birthday' => date('Y-m-d'),
                'position' => '4',
                'department' => '4',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 5,
                'user_id' => 5,
                'user_code' => "05-1-1",
                'gender' => '1',
                'address' => "Thái Bình",
                'phone' => '0393794284',
                'birthday' => date('Y-m-d'),
                'position' => '1',
                'department' => '1',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 6,
                'user_id' => 6,
                'user_code' => "06-1-2",
                'gender' => '1',
                'address' => "Ninh Bình",
                'phone' => '0393794285',
                'birthday' => date('Y-m-d'),
                'position' => '1',
                'department' => '2',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 7,
                'user_id' => 7,
                'user_code' => "07-1-1",
                'gender' => '1',
                'address' => "Hưng Yên",
                'phone' => '0393794286',
                'birthday' => date('Y-m-d'),
                'position' => '1',
                'department' => '1',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 8,
                'user_id' => 8,
                'user_code' => "08-1-1",
                'gender' => '1',
                'address' => "Cao Bằng",
                'phone' => '0393794287',
                'birthday' => date('Y-m-d'),
                'position' => '1',
                'department' => '1',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 9,
                'user_id' => 9,
                'user_code' => "09-1-2",
                'gender' => '1',
                'address' => "Vĩnh Phúc",
                'phone' => '0393794288',
                'birthday' => date('Y-m-d'),
                'position' => '1',
                'department' => '2',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 10,
                'user_id' => 10,
                'user_code' => "10-2-3",
                'gender' => '2',
                'address' => "Nam Định",
                'phone' => '0393794289',
                'birthday' => date('Y-m-d'),
                'position' => '2',
                'department' => '3',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
