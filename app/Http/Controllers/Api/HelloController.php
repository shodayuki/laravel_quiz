<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class HelloController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            // 成功時のレスポンス
            return response()->json([
                'status' => 200,
                'result' => 'ok',
            ], 200);
        } catch (\Exception $e) {
            // エラー時のレスポンス
            return response()->json([
                'status' => 500,
                'result' => 'invalid_request',
            ], 500);
        }
    }
}
