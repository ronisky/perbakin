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
use Modules\Banner\Http\Controllers\BannerController;

Route::prefix('banner')->group(function () {
    Route::get('/', [BannerController::class, 'index']);
    Route::post('/store', [BannerController::class, 'store']);
    Route::post('/update/{id}', [BannerController::class, 'update']);
    Route::get('/delete/{id}', [BannerController::class, 'destroy']);
    Route::get('/getdata/{id}', [BannerController::class, 'getdata']);
    Route::post('/updatestatus/{id}', [BannerController::class, 'updatestatus']);
});
