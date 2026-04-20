<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

/* ROOT → redirect ke login */
Route::get('/', function () {
    return redirect()->route('login');
});

/* AUTH */
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/* ROUTE YANG DILINDUNGI LOGIN */
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');

    Route::resource('anggota', AnggotaController::class);
    Route::resource('petugas', PetugasController::class);

    /*
    |--------------------------------------------------------------------------
    | BUKU ROUTES — dengan pembatasan role
    |--------------------------------------------------------------------------
    | - index & show  : semua role boleh akses (melihat daftar & detail buku)
    | - create, store, edit, update, destroy : hanya Admin
    */

    // Boleh diakses semua role
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');

    // Hanya Admin — WAJIB di atas route /{buku} agar tidak bentrok
    Route::middleware('admin.only')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{buku}/edit', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{buku}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])->name('buku.destroy');
    });

    // Semua role boleh lihat detail — HARUS di bawah /buku/create
    Route::get('/buku/{buku}', [BukuController::class, 'show'])->name('buku.show');

});