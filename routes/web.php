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

    Route::get('/pegawai/login', [AuthController::class, 'showPegawaiLogin'])->name('pegawai.login');
    Route::post('/pegawai/login', [AuthController::class, 'pegawaiLogin'])->middleware('throttle:6,1')->name('pegawai.login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);

    // Google OAuth
    Route::get('/auth/google',          [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

// ─── Protected Routes (hanya untuk user yang sudah login) ─────────────
Route::middleware(['auth', 'role:pemohon'])->group(function () {
    Route::get('/dashboard', function () {
        $latestPengajuan = auth()->user()->latestPengajuan;
        return view('dashboard', compact('latestPengajuan'));
    })->name('dashboard');

    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{jalur}', [PengajuanController::class, 'form'])->name('pengajuan.form');
    Route::post('/pengajuan/{jalur}', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{id}/sukses', [PengajuanController::class, 'sukses'])->name('pengajuan.sukses');
    Route::get('/pengajuan/{id}/perbaikan', [PengajuanController::class, 'editPerbaikan'])->name('pengajuan.perbaikan');
    Route::post('/pengajuan/{id}/perbaikan', [PengajuanController::class, 'updatePerbaikan'])->name('pengajuan.perbaikan.update');
});

// ─── Pegawai Routes (Admin, Verifikator, Pimpinan) ────────────────────
use App\Http\Controllers\PegawaiController;

Route::middleware(['auth', 'role:admin,verifikator,pimpinan'])->prefix('pegawai')->name('pegawai.')->group(function () {
    Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard');
    Route::get('/data-eksternal', [PegawaiController::class, 'dataEksternal'])->name('data-eksternal');
    Route::post('/data-eksternal/import', [PegawaiController::class, 'importDataEksternal'])->name('data-eksternal.import');
    Route::delete('/data-eksternal/{type}/{id}', [PegawaiController::class, 'deleteDataEksternal'])->name('data-eksternal.delete');
    Route::get('/data-eksternal/template/{type}', [PegawaiController::class, 'downloadTemplate'])->name('data-eksternal.template');
    Route::get('/pengajuan/{id}', [PegawaiController::class, 'show'])->name('pengajuan.show');
    Route::post('/pengajuan/{id}/teruskan', [PegawaiController::class, 'teruskan'])->name('pengajuan.teruskan');
    Route::post('/pengajuan/{id}/kembalikan', [PegawaiController::class, 'kembalikan'])->name('pengajuan.kembalikan');
    Route::post('/pengajuan/{id}/tolak', [PegawaiController::class, 'tolak'])->name('pengajuan.tolak');
    Route::post('/pengajuan/{id}/putuskan', [PegawaiController::class, 'putuskan'])->name('pengajuan.putuskan');
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Protected File Serving (dokumen dari storage, bukan public) ───────
Route::middleware('auth')->get('/file/{path}', function (string $path) {
    // Cek lokasi baru (storage) dulu, fallback ke lokasi lama (public) untuk backward compat
    $fullPath = storage_path('app/' . $path);
    if (!file_exists($fullPath)) {
        // Backward compat: file lama mungkin masih di public/
        $fullPath = public_path($path);
        if (!file_exists($fullPath)) {
            abort(404);
        }
    }

    // Pemohon hanya boleh akses file milik sendiri
    $user = auth()->user();
    if ($user->role === 'pemohon') {
        $ownsFile = \App\Models\Pengajuan::where('user_id', $user->id)
            ->where(function ($q) use ($path) {
                $q->where('file_ktp', $path)
                  ->orWhere('file_raport', $path)
                  ->orWhere('file_utbk', $path);
            })->exists();

        if (!$ownsFile) {
            abort(403);
        }
    }

    return response()->file($fullPath);
})->where('path', '.*')->name('file.serve');
