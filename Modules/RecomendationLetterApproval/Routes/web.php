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
use Modules\RecomendationLetterApproval\Http\Controllers\RecomendationLetterApprovalController;

Route::prefix('recomendationletterapproval')->group(function () {
    Route::get('/', [RecomendationLetterApprovalController::class, 'index']);
    Route::post('/update/{id}', [RecomendationLetterApprovalController::class, 'update']);
    Route::get('/show/{id}', [RecomendationLetterApprovalController::class, 'show']);
    // Route::get('/show/{id}', [RecomendationLetterApprovalController::class, 'show']);
    Route::post('/updatestatus/{id}', [RecomendationLetterApprovalController::class, 'updatestatus']);
    Route::get('/delete/{id}', [RecomendationLetterApprovalController::class, 'destroy']);
    Route::get('/printletter/{id}', [RecomendationLetterApprovalController::class, 'printLetter']);
});
