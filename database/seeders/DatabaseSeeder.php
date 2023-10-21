<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $this->call(AnswerTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(InformationTableSeeder::class);
        $this->call(KeywordTableSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(RankingTableDummySeeder::class);
    }
}
