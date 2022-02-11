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
use Modules\Home\Http\Controllers\HomeController;

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
});

Route::prefix('history')->group(function () {
    Route::get('/', [HomeController::class, 'history']);
});

Route::prefix('sponsorships')->group(function () {
    Route::get('/', [HomeController::class, 'sponsorships']);
});

Route::prefix('about-us')->group(function () {
    Route::get('/', [HomeController::class, 'aboutUs']);
});

Route::prefix('management')->group(function () {
    Route::get('/', [HomeController::class, 'management']);
});

Route::prefix('contact')->group(function () {
    Route::get('/', [HomeController::class, 'contact']);
});

Route::prefix('gallery')->group(function () {
    Route::get('/', [HomeController::class, 'gallery']);
});

Route::prefix('clube')->group(function () {
    Route::get('/', [HomeController::class, 'clube']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [HomeController::class, 'articles']);
});
