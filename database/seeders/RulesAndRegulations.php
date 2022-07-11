<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RulesAndRegulations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules_and_regulations')->insert([
            [
                'id' => 1,
                'title' => "Thông tin công ty",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'title' => "Triết lý kinh doanh",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'title' => "Thời gian làm việc và chấm công",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'title' => "Nghỉ phép",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
            , [
                'id' => 5,
                'title' => "Công tác giữ gìn, bảo vệ uy tín và tài sản của Công ty",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 6,
                'title' => "Làm việc ngoài giờ",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 7,
                'title' => "Chế độ công tác",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 8,
                'title' => "Chế độ du lịch",
                'content' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
