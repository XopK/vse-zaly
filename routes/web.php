<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Console\Application;
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

Route::get('/about_studio', function () {
    return view('about_studio');
});

Route::get('/my_studio', function () {
    return view('my_studio');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/halls', function () {
    return view('halls');
});

Route::get('/my_halls', function () {
    return view('my_halls');
});

Route::get('/my_hall', function () {
    return view('my_hall');
});

Route::get('/rent', function () {
    return view('rent');
});

Route::get('/become_partner', function () {
    return view('become_partner');
});

Route::get('/hall', function () {
    return view('hall');
});

Route::get('/studios', function () {
    return view('studios');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/forgot_password', function () {
    return view('forgot_password.forgot_pass');
});

Route::get('/email_confirm', function () {
    return view('email_verified');
});

Route::get('/my_booking', function () {
    return view('my_booking');
});

Route::get('/favourite_properties', function () {
    return view('favourite_properties');
});

Route::get('/change_password', function () {
    return view('change_password');
});

Route::post('/sign_up', [AuthController::class, 'sign_up'])->name('signup');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/sign_in', [AuthController::class, 'sign_in'])->name('signin');

Route::post('/update_personal', [UserController::class, 'update_data'])->name('update_personal_data');

Route::post('/get_resetLink', [ForgotPasswordController::class, 'sendResetLink'])->name('resetPassword');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm']);

Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset_update_password');

Route::post('/become_partner/request', [ApplicationController::class, 'create_application'])->name('request_partner');

Route::get('/email_confirm/get_code', [ConfirmEmailController::class, 'get_code']);

Route::post('/email_confirm/verify', [ConfirmEmailController::class, 'verifyEmail'])->name('verifyEmail');

Route::post('/change_password/update', [UserController::class, 'update_password'])->name('update_password');
