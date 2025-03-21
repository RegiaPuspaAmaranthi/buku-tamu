<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\BiodataTamuController;
use App\Http\Controllers\RekapanTamuController;
use App\Http\Controllers\AuthController;

// Halaman utama untuk tamu (mengisi buku tamu)
Route::get('/', [BukuTamuController::class, 'create'])->name('buku-tamus.create');
Route::post('/store', [BukuTamuController::class, 'store'])->name('buku-tamus.store');

// Login untuk admin/operator
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang hanya bisa diakses admin/operator
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BukuTamuController::class, 'index'])->name('dashboard');
    Route::resource('biodata-tamus', BiodataTamuController::class);
    Route::resource('buku-tamus', BukuTamuController::class)->except(['create', 'store']);
    Route::resource('rekapan-tamus', RekapanTamuController::class);
});
