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
use Modules\Club\Http\Controllers\ClubController;

Route::prefix('club')->group(function () {
    Route::get('/', [ClubController::class, 'index']);
    Route::post('/store', [ClubController::class, 'store']);
    Route::post('/update/{id}', [ClubController::class, 'update']);
    Route::get('/delete/{id}', [ClubController::class, 'destroy']);
    Route::get('/getdata/{id}', [ClubController::class, 'getdata']);
});
