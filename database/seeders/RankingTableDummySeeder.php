<?php

namespace Database\Seeders;

use App\Models\Ranking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankingTableDummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rankings')->truncate();
        DB::table('users')->truncate();

        for ($i = 1; $i <= 5; $i++) {
            Ranking::factory()->count(10)->create([
                'percentage_correct_answer' => rand(0, 2) * 10,
                'created_at' => now()->startOfWeek()->format('Y-m-d')
            ]);

            Ranking::factory()->count(10)->create([
                'percentage_correct_answer' => rand(0, 2) * 10,
                'created_at' => now()->startOfMonth()->format('Y-m-d')
            ]);

            Ranking::factory()->count(10)->create([
                'percentage_correct_answer' => rand(0, 2) * 10,
                'created_at' => now()->startOfYear()->format('Y-m-d')
            ]);
        }
    }
}
