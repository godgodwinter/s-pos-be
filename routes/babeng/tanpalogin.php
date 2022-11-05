<?php

use App\Http\Controllers\admin\adminBuletinController;
use App\Http\Controllers\admin\adminKlasifikasiAkademisController;
use App\Http\Controllers\admin\adminPaketController;
use App\Http\Controllers\admin\adminProsesController;
use App\Http\Controllers\admin\adminReferensiStudiController;
use App\Http\Controllers\AuthOrtuController;
use App\Http\Controllers\AuthSiswaController;
use App\Http\Controllers\cetakController;
use App\Http\Controllers\owner\ownerHasilPsikologiController;
use App\Http\Controllers\tanpalogin\guestKataBijakController;
use Illuminate\Support\Facades\Route;



Route::get('/guest/katabijak', [guestKataBijakController::class, 'index']);
Route::get('/guest/cetak/catatankasus/{siswa_id}', [cetakController::class, 'catatankasus']);
Route::get('/guest/cetak/catatanpengembangandiri/{siswa_id}', [cetakController::class, 'catatanpengembangandiri']);
Route::get('/guest/cetak/catatanprestasi/{siswa_id}', [cetakController::class, 'catatanprestasi']);
Route::get('/guest/cetak/klasifikasi', [cetakController::class, 'klasifikasi']);
Route::get('/guest/cetak/terapis/{siswa_id}', [cetakController::class, 'terapis']);
Route::get('/guest/cetak/penanganan/{siswa_id}', [cetakController::class, 'penanganan']);
Route::get('/guest/cetak/kecerdasanmajemuk/{siswa_id}', [cetakController::class, 'kecerdasanmajemuk']);


Route::get('/guest/cetak/deteksisq/{siswa_id}', [cetakController::class, 'deteksisq']);

Route::get('/guest/cetak/siswaperkelas/{kelas_id}', [adminProsesController::class, 'exportDataSiswaPerkelas']);


Route::get('/guest/hasilpsikologi/detail/{siswa}', [ownerHasilPsikologiController::class, 'detail']);
Route::get('/guest/hasilpsikologi/kecerdasanmajemuk/{siswa}', [ownerHasilPsikologiController::class, 'kecerdasanmajemuk']);
Route::get('/guest/hasilpsikologi/withdetail/{sekolah_id}', [ownerHasilPsikologiController::class, 'withdetail']);


Route::get('/guest/paket', [adminPaketController::class, 'index']);
Route::get('/guest/paket/{paket}', [adminPaketController::class, 'detail']);


//data umum
Route::get('/guest/data/klasifikasi', [adminKlasifikasiAkademisController::class, 'index']);
Route::get('/guest/data/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'edit']);

Route::get('/guest/data/referensi', [adminReferensiStudiController::class, 'index']);
Route::get('/guest/data/referensi/{item}', [adminReferensiStudiController::class, 'edit']);

Route::get('/guest/data/buletin', [adminBuletinController::class, 'index']);
Route::get('/guest/data/buletin/{item}', [adminBuletinController::class, 'edit']);
