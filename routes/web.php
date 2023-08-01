<?php

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
    return view('welcome');
});

Route::get('user-login',[\App\Http\Controllers\UserController::class,'userLoginView'])->name('user.login.view');
Route::get('user-registration',[\App\Http\Controllers\UserController::class,'userRegistrationView'])->name('user.registration.view');
Route::get('user-logout',[\App\Http\Controllers\UserController::class,'userLogoutView'])->name('user.logout.view');
Route::get('user-profile',[\App\Http\Controllers\UserController::class,'userProfileView'])->name('user.profile.view');
Route::get('user-reset-password',[\App\Http\Controllers\UserController::class,'userResetPasswordView'])->name('user.reset.password.view');
Route::get('user-get-otp-code', [\App\Http\Controllers\UserController::class,'getOTPCode'])->name('user.get.otp-code.view');
Route::get('user-verify-otp',[\App\Http\Controllers\UserController::class,'userVerifyOTPView'])->name('user.verify.otp-mail.view')->middleware('token.verified')

Route::post('user/registration',[\App\Http\Controllers\UserController::class,'userRegistration'])->name('user.registration');
Route::post('user/login',[\App\Http\Controllers\UserController::class,'userLogin'])->name('user.login');
Route::get('user/logout',[\App\Http\Controllers\UserController::class,'userLogout'])->name('user.logout');
Route::post('user/send-otp', [\App\Http\Controllers\UserController::class,'sendOTPtoEmail'])->name('user.send.otp');
Route::post('user/reset-password',[\App\Http\Controllers\UserController::class,'resetPassword'])->name('user.reset.password');
Route::post('user/verify-otp-mail',[\App\Http\Controllers\UserController::class,'verifyOTP'])->name('user.verify.otp-mail');
Route::post('user/update-profile',[\App\Http\Controllers\UserController::class,'updateProfile'])->name('user.update.profile');


//After login

Route::get('user-dashboard',[\App\Http\Controllers\DashboarController::class,'dashboardView'])->name('user.dashboard.view')->middleware('token.verified');
