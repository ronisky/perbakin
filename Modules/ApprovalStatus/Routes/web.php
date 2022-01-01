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
use Modules\ApprovalStatus\Http\Controllers\ApprovalStatusController;

Route::prefix('approvalstatus')->group(function () {
    Route::get('/', [ApprovalStatusController::class, 'index']);
    Route::post('/store', [ApprovalStatusController::class, 'store']);
    Route::post('/update/{id}', [ApprovalStatusController::class, 'update']);
    Route::get('/delete/{id}', [ApprovalStatusController::class, 'destroy']);
    Route::get('/getdata/{id}', [ApprovalStatusController::class, 'getdata']);
});
