<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\QuizController;


Route::post('/professeurs', [ProfesseurController::class, 'store']);
Route::post('/professeurs/login', [ProfesseurController::class, 'login']);



Route::middleware('check.token')->group(function () {
    Route::post('/quizzes', [QuizController::class, 'store']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});