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
use Modules\SysTask\Http\Controllers\SysTaskController;

Route::prefix('systask')->group(function () {
    Route::get('/', [SysTaskController::class, 'index']);
    Route::get('/create', [SysTaskController::class, 'create']);
    Route::get('/show/{id}', [SysTaskController::class, 'show']);
    Route::get('/edit/{id}', [SysTaskController::class, 'edit']);
    Route::post('/store', [SysTaskController::class, 'store']);
    Route::post('/update/{id}', [SysTaskController::class, 'update']);
    Route::get('/delete/{id}', [SysTaskController::class, 'destroy']);
    Route::get('/getdata/{id}', [SysTaskController::class, 'getdata']);
});
