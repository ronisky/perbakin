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
use Modules\Faq\Http\Controllers\FaqController;

Route::prefix('faq')->group(function () {
    Route::get('/', [FaqController::class, 'index']);
    Route::post('/store', [FaqController::class, 'store']);
    Route::post('/update/{id}', [FaqController::class, 'update']);
    Route::get('/delete/{id}', [FaqController::class, 'destroy']);
    Route::get('/getdata/{id}', [FaqController::class, 'getdata']);
    Route::get('/show/{id}', [FaqController::class, 'show']);
    Route::post('/updatestatus/{id}', [FaqController::class, 'updatestatus']);
});
