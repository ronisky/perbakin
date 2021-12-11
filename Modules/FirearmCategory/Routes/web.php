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
use Modules\FirearmCategory\Http\Controllers\FirearmCategoryController;

Route::prefix('firearmcategory')->group(function () {
    Route::get('/', [FirearmCategoryController::class, 'index']);
    Route::post('/store', [FirearmCategoryController::class, 'store']);
    Route::post('/update/{id}', [FirearmCategoryController::class, 'update']);
    Route::get('/delete/{id}', [FirearmCategoryController::class, 'destroy']);
    Route::get('/getdata/{id}', [FirearmCategoryController::class, 'getdata']);
});
