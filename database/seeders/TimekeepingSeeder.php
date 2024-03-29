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
                'timekeeping_code' => '01-2022-07',
                'timekeeping_month' => '2022-07-01',
                'day_off' => 1,
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
                'timekeeping_code' => '02-2022-07',
                'timekeeping_month' => '2022-07-01',
                'day_off' => 1,
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
                'timekeeping_code' => '03-2022-07',
                'timekeeping_month' => '2022-07-01',
                'day_off' => 1,
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
                'timekeeping_code' => '04-2022-07',
                'timekeeping_month' => '2022-07-01',
                'day_off' => 1,
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
                'timekeeping_code' => '05-2022-07',
                'timekeeping_month' => '2022-07-01',

                'day_off' => 1,
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
                'timekeeping_code' => '06-2022-07',
                'timekeeping_month' => '2022-07-01',

                'day_off' => 1,
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
                'timekeeping_code' => '07-2022-07',
                'timekeeping_month' => '2022-07-01',

                'day_off' => 1,
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
                'timekeeping_code' => '08-2022-07',
                'timekeeping_month' => '2022-07-01',

                'day_off' => 1,
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
                'timekeeping_code' => '09-2022-07',
                'timekeeping_month' => '2022-07-01',

                'day_off' => 1,
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
                'timekeeping_code' => '10-2022-07',
                'timekeeping_month' => '2022-07-01',

                'day_off' => 1,
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
                'timekeeping_code' => '11-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '12-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '13-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '14-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '15-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '16-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '17-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '18-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '19-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
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
                'timekeeping_code' => '20-2022-03',
                'timekeeping_month' => '2022-03-01',

                'day_off' => 1,
                'working_days' => 24,
                'arrive_late' => 1,
                'hours_late' => 2,
                'leave_early' => 1,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 21,
                'user_id' => 1,
                'timekeeping_code' => '01-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 20,
                'arrive_late' => 1,
                'hours_late' => 1,
                'leave_early' => 1,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 22,
                'user_id' => 2,
                'timekeeping_code' => '02-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 20,
                'arrive_late' => 2,
                'hours_late' => 2,
                'leave_early' => 2,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 23,
                'user_id' => 3,
                'timekeeping_code' => '03-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 20,
                'arrive_late' => 3,
                'hours_late' => 3,
                'leave_early' => 3,
                'hours_early' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 24,
                'user_id' => 4,
                'timekeeping_code' => '04-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 20,
                'arrive_late' => 4,
                'hours_late' => 4,
                'leave_early' => 4,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 25,
                'user_id' => 5,
                'timekeeping_code' => '05-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 21,
                'arrive_late' => 4,
                'hours_late' => 4,
                'leave_early' => 4,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 26,
                'user_id' => 6,
                'timekeeping_code' => '06-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 22,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 2,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 27,
                'user_id' => 7,
                'timekeeping_code' => '07-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 23,
                'arrive_late' => 1,
                'hours_late' => 2,
                'leave_early' => 1,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 28,
                'user_id' => 8,
                'timekeeping_code' => '08-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 24,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 29,
                'user_id' => 9,
                'timekeeping_code' => '09-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 25,
                'arrive_late' => 1,
                'hours_late' => 2,
                'leave_early' => 3,
                'hours_early' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 30,
                'user_id' => 10,
                'timekeeping_code' => '10-2022-01',
                'timekeeping_month' => '2022-01-01',

                'day_off' => 1,
                'working_days' => 21,
                'arrive_late' => 1,
                'hours_late' => 1,
                'leave_early' => 1,
                'hours_early' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 31,
                'user_id' => 11,
                'timekeeping_code' => '11-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 22,
                'arrive_late' => 3,
                'hours_late' => 4,
                'leave_early' => 2,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 32,
                'user_id' => 12,
                'timekeeping_code' => '12-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 25,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 33,
                'user_id' => 13,
                'timekeeping_code' => '13-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 23,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 1,
                'hours_early' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 34,
                'user_id' => 14,
                'timekeeping_code' => '14-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 20,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 35,
                'user_id' => 15,
                'timekeeping_code' => '15-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 24,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 36,
                'user_id' => 16,
                'timekeeping_code' => '16-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 25,
                'arrive_late' => 1,
                'hours_late' => 1,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 37,
                'user_id' => 17,
                'timekeeping_code' => '17-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 25,
                'arrive_late' => 2,
                'hours_late' => 1,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 38,
                'user_id' => 18,
                'timekeeping_code' => '18-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 22,
                'arrive_late' => 4,
                'hours_late' => 1,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 39,
                'user_id' => 19,
                'timekeeping_code' => '19-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
                'working_days' => 24,
                'arrive_late' => 0,
                'hours_late' => 0,
                'leave_early' => 0,
                'hours_early' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ], [
                'id' => 40,
                'user_id' => 20,
                'timekeeping_code' => '20-2022-02',
                'timekeeping_month' => '2022-02-01',

                'day_off' => 1,
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
