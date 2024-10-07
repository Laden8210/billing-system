<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;


Route::post('/login', [LoginController::class, 'login'])->name('login-user');

Route::get('login', [NavigationController::class, 'index'])->name('login');

Route::get('', [NavigationController::class, 'welcome'])->name('welcome');

Route::post('/loginEmployee', [LoginController::class, 'loginEmployee'])->name('login-employee');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [NavigationController::class, 'dashboard'])->name('dashboard');

    Route::get('/service', [NavigationController::class, 'service'])->name('service');
    Route::get('/subscriber', [NavigationController::class, 'subscriber'])->name('subscriber');
    Route::get('/billing', [NavigationController::class, 'billing'])->name('billing');
    Route::get('/payment', [NavigationController::class, 'payment'])->name('payment');
    Route::get('/report', [NavigationController::class, 'report'])->name('report');
    Route::get('/announcement', [NavigationController::class, 'announcement'])->name('announcement');
    Route::get('/complaints', [NavigationController::class, 'complaints'])->name('complaints');

    Route::get('/subscriber/{id}', [NavigationController::class, 'subscriberById'])->name('subscriberById');
});
Route::get('/user', [NavigationController::class, 'userAccount'])->name('user');


Route::get('/subscriberReport', [NavigationController::class, 'generateSubscribersReport'])->name('subscriberReport');
Route::get('paymentReport', [NavigationController::class, 'generatePaymentReport'])->name('paymentReport');
Route::get('remittanceReport', [NavigationController::class, 'remittanceReport'])->name('remittanceReport');
Route::get('complaintsreport', [NavigationController::class, 'complaintsReport'])->name('complaintsreport');
Route::get('billingreport', [NavigationController::class, 'billingreport'])->name('billingreport');
Route::get('announcementreport', [NavigationController::class, 'announcementreport'])->name('announcementreport');
Route::get('/download/app', [NavigationController::class, 'downloadApp'])->name('download.app');


Route::get('forgotPassword', [NavigationController::class, 'forgotPasswordPage'])->name('forgotPassword');
Route::post('send-otp', [NavigationController::class, 'requestOtp'])->name('send-otp');
Route::get('reset-password', [NavigationController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [NavigationController::class, 'changePassword'])->name('reset-password');


Route::post('generate-report', [NavigationController::class, 'generateReport'])->name('generate-report');
