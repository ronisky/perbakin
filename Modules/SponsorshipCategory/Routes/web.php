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
use Modules\SponsorshipCategory\Http\Controllers\SponsorshipCategoryController;

Route::prefix('sponsorshipcategory')->group(function () {
    Route::get('/', [SponsorshipCategoryController::class, 'index']);
    Route::post('/store', [SponsorshipCategoryController::class, 'store']);
    Route::post('/update/{id}', [SponsorshipCategoryController::class, 'update']);
    Route::get('/delete/{id}', [SponsorshipCategoryController::class, 'destroy']);
    Route::get('/getdata/{id}', [SponsorshipCategoryController::class, 'getdata']);
});
