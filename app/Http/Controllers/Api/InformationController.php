<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $information = Information::orderby('id', 'desc')->get(['information','created_at']);

        return response()->json($information);
    }
}
