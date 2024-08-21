<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfirmEmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PartnerController;
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

Route::get('/', [IndexController::class, 'index_view']);

Route::get('/test', function () {
    return view('test');
});

Route::get('/about', [IndexController::class, 'about_view']);

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/rent', function () {
    return view('rent');
});

Route::get('/become_partner', function () {
    return view('become_partner');
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

Route::get('/change_password', function () {
    return view('change_password');
});

Route::get('/my_booking', [UserController::class, 'my_booking'])->name('my_booking');

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

Route::get('/profile/new_email_confirm', [UserController::class, 'new_email_view'])->name('view_email');

Route::post('/profile/new_email_confirm/update', [UserController::class, 'newEmailChange'])->name('newEmailChange');

Route::post('/my_studio/update', [StudioController::class, 'update_studio'])->name('update_studio');

Route::get('/studios', [StudioController::class, 'studios_view']);

Route::get('/about_studio/{studio}', [StudioController::class, 'about_studio']);

Route::get('/my_halls', [HallController::class, 'my_halls']);

Route::get('/my_halls_profile', [PartnerController::class, 'my_halls_profile']);

Route::post('/my_halls/create', [HallController::class, 'create_halls'])->name('create_hall');

Route::get('/hall/{hall}', [HallController::class, 'hall_view']);

Route::get('/my_studio', [StudioController::class, 'my_studio_view']);

Route::get('/my_hall/{hall}', [StudioController::class, 'my_hall_view']);

Route::post('/my_hall/{hall}/update', [HallController::class, 'edit_hall'])->name('edit_hall');

Route::delete('/delete_photo/{photo}', [HallController::class, 'delete_photo']);

Route::post('/update_privew/{photo}', [HallController::class, 'update_preview']);

Route::post('/my_hall/{hall}/add_photo', [HallController::class, 'addPhoto']);

Route::get('/halls', [HallController::class, 'all_halls']);

Route::get('/verify_phone', [SmsController::class, 'sms_verify']);

Route::post('/code_phone', [SmsController::class, 'check_code'])->name('check_code');

Route::post('/booking', [BookingController::class, 'create_booking'])->name('create_booking');

Route::delete('/delete_hall/{hall}', [HallController::class, 'delete_hall']);

Route::post('/favorite', [UserController::class, 'addToFavorite'])->name('favorite.add');

Route::delete('/favorite', [UserController::class, 'removeFromFavorite'])->name('favorite.remove');

Route::get('/favourite_properties', [UserController::class, 'favourite_properties'])->name('favourite.properties');


