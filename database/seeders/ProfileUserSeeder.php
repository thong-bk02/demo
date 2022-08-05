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
                'address' => "Nam Định",
                'phone' => '0393794289',
                'birthday' => date('Y-m-d'),
                'position' => '2',
                'department' => '3',
                'date_start' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
            // ], [
            //     'id' => 11,
            //     'user_id' => 11,
            //     'user_code' => "11-1-2",
            //     'address' => "Quảng Ninh",
            //     'phone' => '0393794290',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '1',
            //     'department' => '2',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 12,
            //     'user_id' => 12,
            //     'user_code' => "12-1-2",
            //     'address' => "Thanh Hóa",
            //     'phone' => '0393794291',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '1',
            //     'department' => '2',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 13,
            //     'user_id' => 13,
            //     'user_code' => "13-2-3",
            //     'address' => "Hà Nội",
            //     'phone' => '0393794292',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '2',
            //     'department' => '3',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 14,
            //     'user_id' => 14,
            //     'user_code' => "14-1-1",
            //     'address' => "Nghệ An",
            //     'phone' => '0393794293',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '1',
            //     'department' => '1',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 15,
            //     'user_id' => 15,
            //     'user_code' => "15-1-1",
            //     'address' => "Đà Nẵng",
            //     'phone' => '0393794294',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '1',
            //     'department' => '1',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 16,
            //     'user_id' => 16,
            //     'user_code' => "16-2-2",
            //     'address' => "Huế",
            //     'phone' => '0393794295',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '2',
            //     'department' => '2',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 17,
            //     'user_id' => 17,
            //     'user_code' => "17-2-1",
            //     'address' => "Lào Cai",
            //     'phone' => '0393794296',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '2',
            //     'department' => '1',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 18,
            //     'user_id' => 18,
            //     'user_code' => "18-3-2",
            //     'address' => "Yên Bái",
            //     'phone' => '0393794297',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '3',
            //     'department' => '2',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 19,
            //     'user_id' => 19,
            //     'user_code' => "19-1-1",
            //     'address' => "Phú Thọ",
            //     'phone' => '0393794298',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '4',
            //     'department' => '4',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ], [
            //     'id' => 20,
            //     'user_id' => 20,
            //     'user_code' => "20-1-1",
            //     'address' => "Quảng Bình",
            //     'phone' => '0393794299',
            //     'birthday' => date('Y-m-d'),
            //     'position' => '1',
            //     'department' => '1',
            //     'date_start' => date('Y-m-d'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s')
            // ]
        ]);
    }
}
