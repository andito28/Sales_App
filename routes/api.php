<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReminderController;

//login & Register
Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/register', [AuthController::class, 'register']);

//Check Reminder
Route::get('v1/check-reminder',[ReminderController::class,'checkReminder']);


Route::group(['middleware' => ['auth:api']], function () {
    //refresh token
    Route::get('v1/refresh-token',[AuthController::class,'refreshToken']);

    //logout
    Route::get('v1/logout',[AuthController::class,'logout']);

    //profile
    Route::get('v1/get-profile',[AuthController::class,'getProfile']);
    Route::put('v1/update-profile',[AuthController::class,'updateProfile']);
});
