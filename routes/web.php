<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view("auth.login");
});

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard_index');
});
