<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reasion')->insert([
            [
                'id' => 1,
                'reasion' => "nghỉ phép"
            ], [
                'id' => 2,
                'reasion' => "nghỉ trừ lương"
            ], [
                'id' => 3,
                'reasion' => "đi muộn"
            ], [
                'id' => 4,
                'reasion' => "về sớm"
            ], [
                'id' => 5,
                'reasion' => "ra ngoài"
            ], [
                'id' => 6,
                'reasion' => "đi công tác"
            ], [
                'id' => 7,
                'reasion' => "làm tại nhà"
            ], [
                'id' => 8,
                'reasion' => "tăng ca"
            ], [
                'id' => 9,
                'reasion' => "thưởng"
            ], [
                'id' => 10,
                'reasion' => "khác"
            ]
        ]);
    }
}
