<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\UserController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        
    });
    
    // Staff routes
    Route::middleware(['role:staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staff'])->name('dashboard');
    });
    
    // Staff Stock routes
    Route::middleware(['role:staff_stock'])->prefix('staff-stock')->name('staff-stock.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staffStock'])->name('dashboard');
        
        // Kelola Buku
        Route::resource('buku', BukuController::class);
    });
    
    // Anggota routes
    Route::middleware(['role:anggota'])->prefix('anggota')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'anggota'])->name('anggota.dashboard');
    });
});

