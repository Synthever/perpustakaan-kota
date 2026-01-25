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
    return view('landing');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile completion routes (authenticated but profile not complete)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/complete', [AuthController::class, 'showCompleteProfile'])->name('profile.complete');
    Route::post('/profile/complete', [AuthController::class, 'storeCompleteProfile'])->name('profile.complete.store');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    
    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        
        // CRUD Anggota
        Route::resource('anggota', AnggotaController::class);
        
        // CRUD Buku
        Route::resource('buku', BukuController::class);
        
        // CRUD Peminjaman
        Route::resource('peminjaman', PeminjamanController::class);
        
        // CRUD Booking
        Route::resource('booking', BookingController::class)->except(['create', 'store']);
        Route::post('booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
        
        // CRUD Denda
        Route::resource('denda', DendaController::class)->only(['index', 'show', 'destroy']);
        Route::post('denda/{denda}/bayar', [DendaController::class, 'bayar'])->name('denda.bayar');
        
        // CRUD Users
        Route::resource('users', UserController::class);
    });
    
    // Staff routes
    Route::middleware(['role:staff'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'staff'])->name('dashboard');
        
        // Kelola Anggota
        Route::resource('anggota', AnggotaController::class);
        
        // Kelola Peminjaman
        Route::resource('peminjaman', PeminjamanController::class);
        
        // Kelola Denda
        Route::get('denda', [DendaController::class, 'index'])->name('denda.index');
        Route::get('denda/{denda}', [DendaController::class, 'show'])->name('denda.show');
        Route::post('denda/{denda}/bayar', [DendaController::class, 'bayar'])->name('denda.bayar');
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
        
        // Booking - memerlukan profil lengkap
        Route::middleware(['profile.complete'])->group(function () {
            Route::get('booking', [BookingController::class, 'index'])->name('anggota.booking.index');
            Route::get('booking/create', [BookingController::class, 'create'])->name('anggota.booking.create');
            Route::post('booking', [BookingController::class, 'store'])->name('anggota.booking.store');
            Route::get('booking/{booking}', [BookingController::class, 'show'])->name('anggota.booking.show');
            Route::delete('booking/{booking}', [BookingController::class, 'destroy'])->name('anggota.booking.destroy');
            
            // Riwayat Peminjaman - memerlukan profil lengkap
            Route::get('peminjaman', [PeminjamanController::class, 'index'])->name('anggota.peminjaman.index');
            Route::get('peminjaman/{peminjaman}', [PeminjamanController::class, 'show'])->name('anggota.peminjaman.show');
            
            // Denda - memerlukan profil lengkap
            Route::get('denda', [DendaController::class, 'index'])->name('anggota.denda.index');
            Route::get('denda/{denda}', [DendaController::class, 'show'])->name('anggota.denda.show');
        });
    });
});

