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
use Modules\History\Http\Controllers\HistoryController;

Route::prefix('history')->group(function () {
    Route::get('/', [HistoryController::class, 'index']);
    Route::post('/store', [HistoryController::class, 'store']);
    Route::post('/update/{id}', [HistoryController::class, 'update']);
    Route::get('/delete/{id}', [HistoryController::class, 'destroy']);
    Route::get('/getdata/{id}', [HistoryController::class, 'getdata']);
});
