<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HafalanController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Middleware auth (wajib login)
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard Umum (Bisa digunakan untuk redirect otomatis ke dashboard masing-masing)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Route KHUSUS GURU
    Route::middleware(['role:guru'])->group(function () {
        Route::get('/dashboard/guru', [DashboardController::class, 'guruIndex'])->name('dashboard.guru');
        Route::post('/hafalan', [HafalanController::class, 'store'])->name('hafalan.store');
    });

    // 3. Route KHUSUS SANTRI
    Route::middleware(['role:santri'])->group(function () {
        Route::get('/dashboard/santri', [DashboardController::class, 'santriIndex'])->name('dashboard.santri');
    });

    // 4. Route Profile (Bisa diakses keduanya)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';