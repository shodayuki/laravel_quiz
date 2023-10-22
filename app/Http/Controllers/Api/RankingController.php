<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ranking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    private $ranking;

    public function __construct(Ranking $ranking)
    {
        $this->ranking = $ranking;
    }

    public function index()
    {
        $weekRanking = Ranking::with('user')
            ->select(DB::raw('MAX(rankings.percentage_correct_answer) as percentage_correct_answer,rankings.user_id,rankings.created_at'))
            ->whereBetween('rankings.created_at', [now()->startOfWeek()->format('Y-m-d'), now()->endOfWeek()->format('Y-m-d')])
            ->limit(5)
            ->orderBy('percentage_correct_answer', 'desc')
            ->groupBy('rankings.user_id','rankings.created_at')
            ->get();

        $weekRankingData = [
            'percentage_correct_answer' => $weekRanking->pluck('percentage_correct_answer')->all(),
            'name' => $weekRanking->pluck('user.name')->all()
        ];

        $monthRanking = Ranking::with('user')
            ->select(DB::raw('MAX(rankings.percentage_correct_answer) as percentage_correct_answer,rankings.user_id,rankings.created_at'))
            ->whereBetween('rankings.created_at', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')])
            ->limit(5)
            ->orderBy('percentage_correct_answer', 'desc')
            ->groupBy('rankings.user_id','rankings.created_at')
            ->get();

        $monthRankingData = [
            'percentage_correct_answer' => $monthRanking->pluck('percentage_correct_answer')->all(),
            'name' => $monthRanking->pluck('user.name')->all()
        ];

        $yearRanking = Ranking::with('user')
            ->select(DB::raw('MAX(rankings.percentage_correct_answer) as percentage_correct_answer,rankings.user_id,rankings.created_at'))
            ->whereBetween('rankings.created_at', [now()->startOfYear()->format('Y-m-d'), now()->endOfYear()->format('Y-m-d')])
            ->limit(5)
            ->orderBy('percentage_correct_answer', 'desc')
            ->groupBy('rankings.user_id','rankings.created_at')
            ->get();

        $yearRankingData = [
            'percentage_correct_answer' => $yearRanking->pluck('percentage_correct_answer')->all(),
            'name' => $yearRanking->pluck('user.name')->all()
        ];

        return [
            'weekRankingData' => $weekRankingData,
            'monthRankingData' => $monthRankingData,
            'yearRankingData' => $yearRankingData,
        ];
    }

    public function insertRanking(Request $request)
    {
        if (auth('api')->user()) {
            $correctRatio = $request->input('correctRatio');
            $userId = auth('api')->user()->id;

            $this->ranking->create([
                'percentage_correct_answer' => (int) $correctRatio * 10,
                'user_id' => $userId,
            ]);
        }
    }
}
