<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WageAgreement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wage_agreement')->insert([
            [
                'id' => 1,
                'user_id' => '1',
                'wage_agreement' => "15000000"
            ], [
                'id' => 2,
                'user_id' => '2',
                'wage_agreement' => "18000000"
            ], [
                'id' => 3,
                'user_id' => '3',
                'wage_agreement' => "22000000"
            ], [
                'id' => 4,
                'user_id' => '4',
                'wage_agreement' => "25000000"
            ], [
                'id' => 5,
                'user_id' => '5',
                'wage_agreement' => "7000000"
            ], [
                'id' => 6,
                'user_id' => '6',
                'wage_agreement' => "12000000"
            ], [
                'id' => 7,
                'user_id' => '7',
                'wage_agreement' => "1000000"
            ], [
                'id' => 8,
                'user_id' => '8',
                'wage_agreement' => "12000000"
            ], [
                'id' => 9,
                'user_id' => '9',
                'wage_agreement' => "10000000"
            ], [
                'id' => 10,
                'user_id' => '10',
                'wage_agreement' => "16500000"
            ]
        ]);
    }
}
