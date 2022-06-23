<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coefficients_salarys')->insert([
            [
                'id' => 1,
                'position' => 1,
                'coefficients_salary' => 1200000
            ], [
                'id' => 2,
                'position' => 2,
                'coefficients_salary' => 1300000
            ], [
                'id' => 3,
                'position' => 3,
                'coefficients_salary' => 1400000
            ], [
                'id' => 4,
                'position' => 4,
                'coefficients_salary' => 1500000
            ], [
                'id' => 5,
                'position' => 5,
                'coefficients_salary' => 1600000
            ], [
                'id' => 6,
                'position' => 6,
                'coefficients_salary' => 1700000
            ]
        ]);
    }
}
