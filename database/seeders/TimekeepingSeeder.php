<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimekeepingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('timekeepings')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'from_date' => 	2022-06-01,
                'to_date' => date('Y-m-d'),
                'working_days' => 20,
                'arrive_late' => 1,
                'hours_late' => 1,
                'leave_early' => 1,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 2,
                'user_id' => 2,
                'from_date' => 2022-06-01,
                'to-date' => date('Y-m-d'),
                'working_days' => 20,
                'arrive_late' => 2,
                'hours_late' => 2,
                'leave_early' => 2,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 3,
                'user_id' => 3,
                'from_date' => 2022-06-01,
                'to-date' => date('Y-m-d'),
                'working_days' => 20,
                'arrive_late' => 3,
                'hours_late' => 3,
                'leave_early' => 3,
                'hours_early' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 4,
                'user_id' => 4,
                'from_date' => 2022-06-01,
                'to-date' => date('Y-m-d'),
                'working_days' => 20,
                'arrive_late' => 4,
                'hours_late' => 4,
                'leave_early' => 4,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
