<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuahController;

// Halaman Depan (Katalog & Transaksi Pembeli)
Route::get('/', [BuahController::class, 'index'])->name('buah.index');
Route::post('/transaksi', [BuahController::class, 'store'])->name('buah.store');

// Rute Update Stok (Mendukung halaman utama & halaman admin)
Route::put('/buah/{id}/stok', [BuahController::class, 'updateStok'])->name('buah.updateStok');
Route::put('/admin/buah/{id}/stok', [BuahController::class, 'updateStok'])->name('admin.buah.updateStok');

// Halaman Admin
Route::get('/admin/buah', [BuahController::class, 'adminIndex'])->name('admin.buah');
Route::post('/admin/buah', [BuahController::class, 'storeBuah'])->name('admin.buah.store');