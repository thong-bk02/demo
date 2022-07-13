<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('powers')->insert([
            [
                'id' => 1,
                'position_id' => 2,
                'users' => '0',
                'position' => '0',
                'department' => '0',
                'terms_and_service' => '0',
                'event' => '0',
                'salary' => '0',
                'timekeeping' => '0',
                'reward_and_disciplines' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'position_id' => 3,
                'users' => '0',
                'position' => '0',
                'department' => '0',
                'terms_and_service' => '0',
                'event' => '0',
                'salary' => '0',
                'timekeeping' => '0',
                'reward_and_disciplines' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'position_id' => 4,
                'users' => '0',
                'position' => '0',
                'department' => '1',
                'terms_and_service' => '1',
                'event' => '1',
                'salary' => '0',
                'timekeeping' => '0',
                'reward_and_disciplines' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'position_id' => 5,
                'users' => '1',
                'position' => '1',
                'department' => '0',
                'terms_and_service' => '0',
                'event' => '0',
                'salary' => '0',
                'timekeeping' => '1',
                'reward_and_disciplines' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'position_id' => 6,
                'users' => '0',
                'position' => '0',
                'department' => '0',
                'terms_and_service' => '0',
                'event' => '0',
                'salary' => '1',
                'timekeeping' => '1',
                'reward_and_disciplines' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
