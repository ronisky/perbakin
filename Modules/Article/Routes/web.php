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
use Modules\Article\Http\Controllers\ArticleController;

Route::prefix('article')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/store', [ArticleController::class, 'store']);
    Route::post('/update/{id}', [ArticleController::class, 'update']);
    Route::get('/delete/{id}', [ArticleController::class, 'destroy']);
    Route::get('/getdata/{id}', [ArticleController::class, 'getdata']);
    Route::post('/updatestatus/{id}', [ArticleController::class, 'updatestatus']);
});
