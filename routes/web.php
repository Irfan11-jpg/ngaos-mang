<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; // Tambahan untuk memanggil Controller kita
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HafalanController;

Route::middleware(['auth'])->group(function () {
    Route::post('/hafalan', [HafalanController::class, 'store'])->name('hafalan.store');
});

Route::get('/', function () {
    return view('welcome');
});

// Baris ini yang diubah: mengarahkan /dashboard ke DashboardController
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';