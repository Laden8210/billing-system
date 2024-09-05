<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;


Route::post('/login', [LoginController::class, 'login'])->name('login-user');

Route::get('', [NavigationController::class, 'index'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});
Route::get('/dashboard', [NavigationController::class, 'dashboard'])->name('dashboard');
Route::get('/user', [NavigationController::class, 'userAccount'])->name('user');
Route::get('/service', [NavigationController::class, 'service'])->name('service');
Route::get('/subscriber', [NavigationController::class, 'subscriber'])->name('subscriber');
Route::get('/billing', [NavigationController::class, 'billing'])->name('billing');
Route::get('/payment', [NavigationController::class, 'payment'])->name('payment');
Route::get('/report', [NavigationController::class, 'report'])->name('report');
Route::get('/announcement', [NavigationController::class, 'announcement'])->name('announcement');
Route::get('/complaints', [NavigationController::class, 'complaints'])->name('complaints');
