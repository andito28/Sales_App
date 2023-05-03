<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/register', [AuthController::class, 'register']);
Route::get('v1/logout',[AuthController::class,'logout'])->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function () {

});
