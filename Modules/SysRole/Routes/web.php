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
use Modules\SysRole\Http\Controllers\SysRoleController;

Route::prefix('sysrole')->group(function () {
    Route::get('/', [SysRoleController::class, 'index']);
    Route::get('/create',  [SysRoleController::class, 'create']);
    Route::get('/show/{id}',  [SysRoleController::class, 'show']);
    Route::get('/edit/{id}',  [SysRoleController::class, 'edit']);
    Route::post('/store',  [SysRoleController::class, 'store']);
    Route::post('/update/{id}',  [SysRoleController::class, 'update']);
    Route::get('/delete/{id}',  [SysRoleController::class, 'destroy']);
    Route::get('/getdata/{id}',  [SysRoleController::class, 'getdata']);
});
