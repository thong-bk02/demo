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
                'type' => 1,
                'reasion' => 'reasion 1',
                'note' => '',
                'money' => 500000,
                'date_create' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'user_id' => 2,
                'type' => 2,
                'reasion' => 'reasion 2',
                'note' => '',
                'money' => 500000,
                'date_create' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'user_id' => 3,
                'type' => 1,
                'reasion' => 'reasion 3',
                'note' => '',
                'money' => 500000,
                'date_create' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'user_id' => 4,
                'type' => 2,
                'reasion' => 'reasion 4',
                'note' => '',
                'money' => 500000,
                'date_create' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
