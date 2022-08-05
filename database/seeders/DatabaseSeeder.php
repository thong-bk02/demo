<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PositionSeeder::class,
            DepartmentSeeder::class,
            PowerSeeder::class,
            UserSeeder::class,
            ProfileUserSeeder::class,
            // TimekeepingSeeder::class,
            GenreSeeder::class,
            BasicSalarySeeder::class,
            ReasionSeeder::class,
            RewardAndDisciplineSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
