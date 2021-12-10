<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\RecomendationLetter\Http\Controllers\RecomendationLetterController;

Route::prefix('recomendationletter')->group(function () {
    Route::get('/', [RecomendationLetterController::class, 'index']);
    Route::get('/create', [RecomendationLetterController::class, 'create']);
    Route::get('/show/{id}', [RecomendationLetterController::class, 'show']);
    Route::post('/store', [RecomendationLetterController::class, 'store']);
    Route::post('/update/{id}', [RecomendationLetterController::class, 'update']);
    Route::get('/delete/{id}', [RecomendationLetterController::class, 'destroy']);
    Route::get('/getdata/{id}', [RecomendationLetterController::class, 'getdata']);
});
