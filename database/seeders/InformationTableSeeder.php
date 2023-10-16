<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->truncate();

        DB::table('information')->insert([
           'information' => '最初のお知らせです。',
           'created_at' => now(),
           'updated_at' => now()
        ]);
    }
}
