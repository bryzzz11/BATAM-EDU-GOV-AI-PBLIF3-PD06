<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ────────────────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

Route::get('/bantuan', function () {
    return view('bantuan');
})->name('bantuan');

// ─── Auth Routes (hanya untuk guest) ─────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    // Google OAuth
    Route::get('/auth/google',          [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// ─── Protected Routes (hanya untuk user yang sudah login) ─────────────
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $latestPengajuan = auth()->user()->latestPengajuan;
        return view('dashboard', compact('latestPengajuan'));
    })->name('dashboard');

    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{jalur}', [PengajuanController::class, 'form'])->name('pengajuan.form');
    Route::post('/pengajuan/{jalur}', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{id}/sukses', [PengajuanController::class, 'sukses'])->name('pengajuan.sukses');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
