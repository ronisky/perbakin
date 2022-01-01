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
use Modules\ArticleCategory\Http\Controllers\ArticleCategoryController;

Route::prefix('articlecategory')->group(function () {
    Route::get('/', [ArticleCategoryController::class, 'index']);
    Route::post('/store', [ArticleCategoryController::class, 'store']);
    Route::post('/update/{id}', [ArticleCategoryController::class, 'update']);
    Route::get('/delete/{id}', [ArticleCategoryController::class, 'destroy']);
    Route::get('/getdata/{id}', [ArticleCategoryController::class, 'getdata']);
});
