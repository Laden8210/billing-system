<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [ApiController::class, 'login']);


Route::post('/subscriptions', [ApiController::class, 'subscriptions']);


Route::post('/sendComplaint', [ApiController::class, 'sendComplaint']);
Route::post('/retrieveComplaints', [ApiController::class, 'retrieveComplaints']);

Route::post('/notification', [ApiController::class, 'notification']);


Route::post('area', [ApiController::class, 'getArea']);

Route::post('collections', [ApiController::class, 'collections']);
