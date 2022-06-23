<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('income_taxs')->insert([
            [
                'id' => 1,
                'position' => 1,
                'income_tax' => 5
            ], [
                'id' => 2,
                'position' => 2,
                'income_tax' => 6
            ], [
                'id' => 3,
                'position' => 3,
                'income_tax' => 7
            ], [
                'id' => 4,
                'position' => 4,
                'income_tax' => 8
            ], [
                'id' => 5,
                'position' => 5,
                'income_tax' => 9
            ], [
                'id' => 6,
                'position' => 6,
                'income_tax' => 10
            ]
        ]);
    }
}
