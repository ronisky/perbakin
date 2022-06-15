<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\Home\Http\Controllers\HomeController;

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

// Route::group(['middleware' => ['auth']], function () {

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'register']);
Route::get('/forgot', [UserController::class, 'forgot']);
Route::post('/do_forgot', [UserController::class, 'sendforgot']);
Route::post('/do_login', [UserController::class, 'authenticate']);
Route::post('/do_register', [UserController::class, 'registration']);

// Route::view('/unauthorize', 'exceptions.unauthorize');
// Route::view('/', 			'layouts.landing');

Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');
Route::get('/setting', [UserController::class, 'settingProfile'])->middleware('auth');
Route::post('/changepassword', [UserController::class, 'changepassword'])->middleware('auth');
// });
