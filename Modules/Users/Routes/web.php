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
use Modules\Users\Http\Controllers\UsersController;

Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/create', [UsersController::class, 'create']);
    Route::get('/edit/{id}', [UsersController::class, 'edit']);
    Route::post('/store', [UsersController::class, 'store']);
    Route::post('/update/{id}', [UsersController::class, 'update']);
    Route::get('/delete/{id}', [UsersController::class, 'destroy']);
    Route::get('/getdata/{id}', [UsersController::class, 'getdata']);
    Route::get('/show/{id}', [UsersController::class, 'show']);
    Route::post('/updatestatus/{id}', [UsersController::class, 'updatestatus']);
});
