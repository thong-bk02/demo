<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardAndDisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reward_and_disciplines')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'type' => 2,
                'reasion' => 1,
                'note' => '',
                'money' => 0,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'user_id' => 2,
                'type' => 2,
                'reasion' => 2,
                'note' => '',
                'money' => 500000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'user_id' => 3,
                'type' => 2,
                'reasion' => 3,
                'note' => '',
                'money' => 50000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'user_id' => 4,
                'type' => 2,
                'reasion' => 4,
                'note' => '',
                'money' => 200000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'id' => 5,
                'user_id' => 5,
                'type' => 2,
                'reasion' => 5,
                'note' => '',
                'money' => 20000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 6,
                'user_id' => 6,
                'type' => 2,
                'reasion' => 6,
                'note' => '',
                'money' => 0,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 7,
                'user_id' => 7,
                'type' => 2,
                'reasion' => 7,
                'note' => '',
                'money' => 0,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 8,
                'user_id' => 8,
                'type' => 1,
                'reasion' => 8,
                'note' => '',
                'money' => 500000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
            , [
                'id' => 9,
                'user_id' => 9,
                'type' => 1,
                'reasion' => 9,
                'note' => '',
                'money' => 1000000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
            , [
                'id' => 10,
                'user_id' => 10,
                'type' => 1,
                'reasion' => 10,
                'note' => '',
                'money' => 700000,
                'date_created' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
