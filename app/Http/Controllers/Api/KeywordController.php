<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index(Request $request)
    {
        $initial = $request->input('initial');
        $keyword = Keyword::with('category')
            ->where('keywords.initial', '=', $initial)
            ->orderBy('keywords.keyword')
            ->get();

        return $keyword;
    }
}
