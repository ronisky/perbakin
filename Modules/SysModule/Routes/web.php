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
use Modules\SysModule\Http\Controllers\SysModuleController;

Route::prefix('sysmodule')->group(function () {
    Route::get('/', [SysModuleController::class, 'index']);
    Route::get('/create', [SysModuleController::class, 'create']);
    Route::get('/show/{id}', [SysModuleController::class, 'show']);
    Route::get('/edit/{id}', [SysModuleController::class, 'edit']);
    Route::post('/store', [SysModuleController::class, 'store']);
    Route::post('/update/{id}', [SysModuleController::class, 'update']);
    Route::get('/delete/{id}', [SysModuleController::class, 'destroy']);
    Route::get('/getdata/{id}', [SysModuleController::class, 'getdata']);
});
