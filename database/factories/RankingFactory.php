<?php

namespace Database\Factories;

use App\Models\Ranking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RankingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'percentage_correct_answer' => rand(0, 10) * 10,
        ];
    }
}
