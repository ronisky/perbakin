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
use Modules\LetterCategory\Http\Controllers\LetterCategoryController;

Route::prefix('lettercategory')->group(function () {
    Route::get('/', [LetterCategoryController::class, 'index']);
    Route::post('/store', [LetterCategoryController::class, 'store']);
    Route::post('/update/{id}', [LetterCategoryController::class, 'update']);
    Route::get('/delete/{id}', [LetterCategoryController::class, 'destroy']);
    Route::get('/getdata/{id}', [LetterCategoryController::class, 'getdata']);
});
