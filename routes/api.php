<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\EmailController;

Route::post('/register',RegisterController::class)->name('register');
Route::post('/login',[AuthenticationController::class,'login']);
Route::get('/logout',[AuthenticationController::class,'logout'])->middleware(['auth:sanctum']);
Route::post('send-email',[EmailController::class,'sendEmail'])->middleware(['auth:sanctum']);


