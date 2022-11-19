<?php

use App\Http\Controllers\cetakController;
use App\Http\Controllers\tanpalogin\guestKatalogController;
use Illuminate\Support\Facades\Route;



Route::get('/v1/produk', [guestKatalogController::class, 'index']);
Route::get('/v1/produk/{item}', [guestKatalogController::class, 'edit']);
Route::get('/v1/produk/{slug}/slug', [guestKatalogController::class, 'slug']);
Route::get('/v1/produk_cari/', [guestKatalogController::class, 'cari']);
// Route::get('/guest/katabijak', [guestKataBijakController::class, 'index']);
// Route::get('/guest/cetak/catatankasus/{siswa_id}', [cetakController::class, 'catatankasus']);
// Route::get('/guest/cetak/catatanpengembangandiri/{siswa_id}', [cetakController::class, 'catatanpengembangandiri']);
// Route::get('/guest/cetak/catatanprestasi/{siswa_id}', [cetakController::class, 'catatanprestasi']);
// Route::get('/guest/cetak/klasifikasi', [cetakController::class, 'klasifikasi']);
// Route::get('/guest/cetak/terapis/{siswa_id}', [cetakController::class, 'terapis']);
// Route::get('/guest/cetak/penanganan/{siswa_id}', [cetakController::class, 'penanganan']);
// Route::get('/guest/cetak/kecerdasanmajemuk/{siswa_id}', [cetakController::class, 'kecerdasanmajemuk']);
