<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'id' => 1,
                'payment' => 'tiền mặt'
            ], [
                'id' => 2,
                'payment' => 'thẻ tín dụng'
            ], [
                'id' => 3,
                'payment' => 'chuyển khoản'
            ]
        ]);
    }
}
