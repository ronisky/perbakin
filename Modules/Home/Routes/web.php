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
    Route::get('/histories', [HomeController::class, 'histories']);
    Route::get('/sponsorships', [HomeController::class, 'sponsorships']);
    Route::get('/about-us', [HomeController::class, 'aboutUs']);
    Route::get('/management', [HomeController::class, 'management']);
    Route::get('/contact', [HomeController::class, 'contact']);
    Route::get('/galleries', [HomeController::class, 'galleries']);
    Route::get('/clubs', [HomeController::class, 'clubs']);
    Route::get('/articles', [HomeController::class, 'articles']);

    Route::get('/details/{id}', [HomeController::class, 'detailArticle']);
    Route::get('/image/{id}', [HomeController::class, 'detailImage']);
});

Route::prefix('histories')->group(function () {
    Route::get('/', [HomeController::class, 'histories']);
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

Route::prefix('galleries')->group(function () {
    Route::get('/', [HomeController::class, 'galleries']);
});

Route::prefix('clubs')->group(function () {
    Route::get('/', [HomeController::class, 'clubs']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [HomeController::class, 'articles']);
});

Route::prefix('details')->group(function () {
    Route::get('/', [HomeController::class, 'articles']);
});

Route::prefix('details/{id}')->group(function () {
    Route::get('/', [HomeController::class, 'detailArticle']);
});
Route::prefix('image/{id}')->group(function () {
    Route::get('/', [HomeController::class, 'detailImage']);
});

Route::get('/details/{id}', [HomeController::class, 'detailArticle']);
Route::get('/image/{id}', [HomeController::class, 'detailImage']);
