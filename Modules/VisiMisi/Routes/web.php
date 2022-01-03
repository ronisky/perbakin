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
use Modules\VisiMisi\Http\Controllers\VisiMisiController;

Route::prefix('visimisi')->group(function () {
    Route::get('/', [VisiMisiController::class, 'index']);
    Route::post('/store', [VisiMisiController::class, 'store']);
    Route::post('/update/{id}', [VisiMisiController::class, 'update']);
    Route::get('/delete/{id}', [VisiMisiController::class, 'destroy']);
    Route::get('/getdata/{id}', [VisiMisiController::class, 'getdata']);
    Route::post('/updatestatus/{id}', [VisiMisiController::class, 'updatestatus']);
});
