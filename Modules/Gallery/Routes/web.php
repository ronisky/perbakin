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
use Modules\Gallery\Http\Controllers\GalleryController;

Route::prefix('gallery')->group(function () {
    Route::get('/', [GalleryController::class, 'index']);
    Route::post('/store', [GalleryController::class, 'store']);
    Route::post('/update/{id}', [GalleryController::class, 'update']);
    Route::get('/delete/{id}', [GalleryController::class, 'destroy']);
    Route::get('/getdata/{id}', [GalleryController::class, 'getdata']);
    Route::post('/updatestatus/{id}', [GalleryController::class, 'updatestatus']);
});
