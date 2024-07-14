<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/halls', function () {
    return view('halls');
});

Route::get('/rent', function () {
    return view('rent');
});

Route::get('/hall', function () {
    return view('hall');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/forgot_password', function () {
    return view('forgotpass');
});

Route::post('/sign_up', [AuthController::class, 'sign_up'])->name('signup');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/sign_in', [AuthController::class, 'sign_in'])->name('signin');

Route::post('/update_personal', [UserController::class, 'update_data'])->name('update_personal_data');
