<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\InformationController;
use App\Http\Controllers\Api\KeywordController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\RankingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/informations', [InformationController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/keywords', [KeywordController::class, 'index']);
Route::get('/ranking', [RankingController::class, 'index']);
Route::post('/register', [RegisteredUserController::class, 'apiRegister']);
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'apiLogin']);