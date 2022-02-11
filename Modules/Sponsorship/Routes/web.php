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
use Modules\Sponsorship\Http\Controllers\SponsorshipController;

Route::prefix('sponsorship')->group(function () {
    Route::get('/', [SponsorshipController::class, 'index']);
    Route::post('/store', [SponsorshipController::class, 'store']);
    Route::post('/update/{id}', [SponsorshipController::class, 'update']);
    Route::get('/delete/{id}', [SponsorshipController::class, 'destroy']);
    Route::get('/getdata/{id}', [SponsorshipController::class, 'getdata']);
    Route::get('/show/{id}', [SponsorshipController::class, 'show']);
    Route::post('/updatestatus/{id}', [SponsorshipController::class, 'updatestatus']);
});
