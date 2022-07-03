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
    Route::get('/homeclubs', [HomeController::class, 'homeclubs']);
    Route::get('/articles', [HomeController::class, 'articles']);

    Route::get('/detailarticle/{id}', [HomeController::class, 'detailArticle']);
    Route::get('/detailimage/{id}', [HomeController::class, 'detailImage']);
    Route::get('/detailclub/{id}', [HomeController::class, 'detailClub']);
    Route::post('/storefaq', [HomeController::class, 'storeFaq']);
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

Route::prefix('homeclubs')->group(function () {
    Route::get('/', [HomeController::class, 'homeclubs']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [HomeController::class, 'articles']);
});
