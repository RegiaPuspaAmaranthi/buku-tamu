<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\BiodataTamuController;
use App\Http\Controllers\RekapanTamuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// =======================
// Landing Page (Public)
// =======================
Route::get('/', function () {
    return view('landing'); // file: resources/views/landing.blade.php
})->name('landing');

// =======================
// Form Buku Tamu (Public)
// =======================
Route::get('/buku-tamu', [BukuTamuController::class, 'create'])->name('buku-tamus.create');
Route::post('/buku-tamu', [BukuTamuController::class, 'store'])->name('buku-tamus.store');

// =======================
// Login Admin / Operator
// =======================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// Admin Area (Protected)
// =======================
Route::middleware('auth')->group(function () {

    // Dashboard Admin
    // Route::get('/dashboard', [BukuTamuController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    // Buku Tamu - Data (tanpa create & store karena sudah di luar middleware)
    Route::resource('buku-tamus', BukuTamuController::class)->except(['create', 'store']);
    Route::get('/buku-tamus', [BukuTamuController::class, 'index'])->name('buku-tamus.index');


    // Biodata Tamu
    Route::get('/biodata-tamus', [BiodataTamuController::class, 'index'])->name('biodata-tamus.index');
    Route::get('/biodata-tamus/create', [BiodataTamuController::class, 'create'])->name('biodata-tamus.create');
    Route::post('/biodata-tamus', [BiodataTamuController::class, 'store'])->name('biodata-tamus.store');
    Route::get('/biodata-tamus/export', [BiodataTamuController::class, 'export'])->name('biodata-tamus.export');
    Route::resource('biodata-tamus', BiodataTamuController::class)->only(['edit', 'update', 'destroy']);

    // Rekapan Tamu
    Route::get('/rekapan', [RekapanTamuController::class, 'index'])->name('rekapan.index');
    Route::post('/rekapan/export', [RekapanTamuController::class, 'export'])->name('rekapan.export');
});
