<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('dashboard_index');
Route::get('/sales', [HomeController::class, 'sales'])->name('dashboard.sales');
Route::get('/transaksi', [HomeController::class, 'transaksi'])->name('dashboard.transaksi');
Route::post('/confirmation', [HomeController::class, 'confirm'])->name('dashboard.confirm');
Route::get('/show-confirmation/{id}', [HomeController::class, 'showConfirm'])->name('dashboard.confirm.show');
