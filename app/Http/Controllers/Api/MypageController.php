<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ranking;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function index()
    {
        $myScore = Ranking::select('percentage_correct_answer', 'created_at')
            ->where('user_id', '=', auth('api')->user()->id)
            ->orderby('created_at', 'asc')
            ->limit(100)
            ->get();

        $myScoreGraphData = [
            'percentage_correct_answer' => $myScore->pluck('percentage_correct_answer')->all(),
            'created_at' => $myScore->pluck('created_at')->all()
        ];

        return $myScoreGraphData;
    }
}
