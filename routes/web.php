<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ✅ Halaman utama redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ✅ Route Dashboard per Role (pakai middleware auth + role)
Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/dashboard/guru', [DashboardController::class, 'guru'])
        ->name('dashboard.guru');
});

Route::middleware(['auth', 'role:santri'])->group(function () {
    Route::get('/dashboard/santri', [DashboardController::class, 'santri'])
        ->name('dashboard.santri');
});

// Route Profile (bawaan Breeze, tetap dipertahankan)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';