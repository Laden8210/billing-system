<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [ApiController::class, 'login']);
Route::post('/loginEmployee', [ApiController::class, 'loginEmployee']);


Route::post('/subscriptions', [ApiController::class, 'subscriptions']);


Route::post('/sendComplaint', [ApiController::class, 'sendComplaint']);
Route::post('/retrieveComplaints', [ApiController::class, 'retrieveComplaints']);

Route::post('/notification', [ApiController::class, 'notification']);


Route::post('area', [ApiController::class, 'getArea']);

Route::post('collections', [ApiController::class, 'collections']);
Route::post('getOneCollection', [ApiController::class, 'getOneCollection']);
Route::post('getPlan', [ApiController::class, 'getPlan']);

Route::post('recordPayment', [ApiController::class, 'recordPayment']);


Route::post('upload', [ImageUploadController::class, 'uploadImage']);

Route::post('requestOtp', [ApiController::class, 'requestOtp']);


Route::post('changePassword', [ApiController::class, 'changePassword']);
