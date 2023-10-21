<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ranking extends Model
{
    use HasFactory;

    protected $table = 'rankings';

    public function insertScore(int $correctRatio, int $userId)
    {
        $ranking = new Ranking();
        $correctRatio = $ranking->percentage_correct_answer;
        $userId = $ranking->user_id;
        $ranking->save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
