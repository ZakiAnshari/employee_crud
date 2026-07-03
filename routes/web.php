<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AksesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }

    return redirect()->route('login');
});

Route::middleware('redirectIfAuth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
});

//LOGGED IN (admin & user)
Route::middleware(['auth'])->group(function () {
    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout']);
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // MANAJEMEN KARYAWAN (lihat & detail boleh diakses semua role)
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::get('/karyawan/{id}/show', [KaryawanController::class, 'show'])->name('karyawan.show');

    //ADMIN ONLY
    Route::middleware('admin')->group(function () {
        Route::post('/karyawan-add', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::post('/karyawan/{id}/edit', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::get('/karyawan-destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

        // LOG AKTIVITAS
        Route::get('/log-aktivitas', [ActivityLogController::class, 'index'])->name('activity-log.index');

        // MANAJEMEN AKSES
        Route::get('/akses', [AksesController::class, 'index'])->name('akses.index');
        Route::post('/akses-add', [AksesController::class, 'store'])->name('akses.store');
        Route::get('/akses/{id}/edit', [AksesController::class, 'edit'])->name('akses.edit');
        Route::post('/akses/{id}/edit', [AksesController::class, 'update'])->name('akses.update');
        Route::get('/akses-destroy/{id}', [AksesController::class, 'destroy'])->name('akses.destroy');
    });
});