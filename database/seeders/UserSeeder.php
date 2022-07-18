<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => "Nguyễn Thúy Quỳnh",
                'email' => "quynh@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'name' => "Phạm Đoàn Anh Tuấn",
                'email' => "tuan@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'name' => "Hà Anh Hoàng",
                'email' => "hoang@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'name' => "Phạm Thanh Sơn",
                'email' => "son@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
            , [
                'id' => 5,
                'name' => "Trần Công Minh",
                'email' => "minh@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 6,
                'name' => "Trần Đức Thắng",
                'email' => "thang@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 7,
                'name' => "Trần Mạnh Cường",
                'email' => "cuong@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 8,
                'name' => "Nguyễn Chí Hào",
                'email' => "hao@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 9,
                'name' => "Phạm Tân Đại",
                'email' => "dai@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 10,
                'name' => "Lâm Thị Thúy",
                'email' => "thuy@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 11,
                'name' => "Vũ Quý Văn",
                'email' => "van@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 12,
                'name' => "Nguyễn Đăng Đức",
                'email' => "duc@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 13,
                'name' => "Nguyễn Đình Hùng",
                'email' => "hung@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 14,
                'name' => "Trần Minh Trang",
                'email' => "trang@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 15,
                'name' => "Đào Văn Phúc",
                'email' => "phuc@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 16,
                'name' => "Trần Duy Chiến",
                'email' => "chien@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 17,
                'name' => "Đỗ Thị Oanh",
                'email' => "oanh@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 18,
                'name' => "Vũ Hương Giang",
                'email' => "giang@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 19,
                'name' => "Trần Thu Hằng",
                'email' => "hang@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 20,
                'name' => "Đinh Quốc Việt",
                'email' => "viet@gmail.com",
                'status' => 1,
                'password' => Hash::make('thongbk02'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
