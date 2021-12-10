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
use Modules\SysMenu\Http\Controllers\SysMenuController;

Route::prefix('sysmenu')->group(function () {
    Route::get('/', [SysMenuController::class, 'index']);
    Route::get('/create', [SysMenuController::class, 'create']);
    Route::get('/show/{id}', [SysMenuController::class, 'show']);
    Route::get('/edit/{id}', [SysMenuController::class, 'edit']);
    Route::post('/store', [SysMenuController::class, 'store']);
    Route::post('/update/{id}', [SysMenuController::class, 'update']);
    Route::get('/delete/{id}', [SysMenuController::class, 'destroy']);
    Route::get('/getdata/{id}', [SysMenuController::class, 'getdata']);
});
