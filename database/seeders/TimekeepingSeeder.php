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
                'from_date' => '2022-07-01',
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
                'from_date' => '2022-07-01',
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
                'from_date' => '2022-07-01',
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
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 20,
                'arrive_late' => 4,
                'hours_late' => 4,
                'leave_early' => 4,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 5,
                'user_id' => 5,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 21,
                'arrive_late' => 4,
                'hours_late' => 4,
                'leave_early' => 4,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 6,
                'user_id' => 6,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 22,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 2,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 7,
                'user_id' => 7,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 23,
                'arrive_late' => 1,
                'hours_late' => 2,
                'leave_early' => 1,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 8,
                'user_id' => 8,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 24,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 9,
                'user_id' => 9,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 25,
                'arrive_late' => 1,
                'hours_late' => 2,
                'leave_early' => 3,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 10,
                'user_id' => 10,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 21,
                'arrive_late' => 1,
                'hours_late' => 1,
                'leave_early' => 1,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 11,
                'user_id' => 11,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 22,
                'arrive_late' => 3,
                'hours_late' => 4,
                'leave_early' => 2,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 12,
                'user_id' => 12,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 25,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 13,
                'user_id' => 13,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 23,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 1,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 14,
                'user_id' => 14,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 20,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 15,
                'user_id' => 15,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 24,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 16,
                'user_id' => 16,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 25,
                'arrive_late' => 1,
                'hours_late' => 1,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 17,
                'user_id' => 17,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 25,
                'arrive_late' => 2,
                'hours_late' => 1,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 18,
                'user_id' => 18,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 22,
                'arrive_late' => 4,
                'hours_late' => 1,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 19,
                'user_id' => 19,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 24,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 20,
                'user_id' => 20,
                'from_date' => '2022-07-01',
                'to-date' => date('Y-m-d'),
                'working_days' => 24,
                'arrive_late' => 1,
                'hours_late' => 2,
                'leave_early' => 1,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
