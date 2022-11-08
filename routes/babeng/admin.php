<?php

use App\Http\Controllers\admin\adminAdministratorController;
use App\Http\Controllers\admin\adminLabelController;
use App\Http\Controllers\admin\adminPegawaiController;
use App\Http\Controllers\admin\adminProdukController;
use App\Http\Controllers\admin\adminRestokController;
use App\Http\Controllers\admin\adminSettingsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('/admin/auth/login', [AuthController::class, 'login'])->name('admin.auth.login');
// Route::post('/admin/auth/register', [AuthController::class, 'register'])->name('admin.auth.register');
// Route::middleware('api')->group(function () {
Route::middleware('auth:api')->group(function () {
    //menu-auth
    Route::post('/admin/auth/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    Route::post('/admin/auth/refresh', [AuthController::class, 'refresh'])->name('admin.auth.refresh');
    Route::post('/admin/auth/me', [AuthController::class, 'me'])->name('admin.auth.me');

    Route::post("admin/auth/profile", [AuthController::class, 'refresh']);
    // update
    Route::post("admin/auth/profile/update", [AuthController::class, 'update']);

    Route::get('/admin/settings/get', [adminSettingsController::class, 'index'])->name('admin.settings.get');



    Route::get('/admin/administrator', [adminAdministratorController::class, 'index']);
    Route::post('/admin/administrator', [adminAdministratorController::class, 'store']);
    Route::get('/admin/administrator/{item}', [adminAdministratorController::class, 'edit']);
    Route::put('/admin/administrator/{item}', [adminAdministratorController::class, 'update']);
    Route::delete('/admin/administrator/{item}', [adminAdministratorController::class, 'destroy']);
    Route::delete('/admin/administrator/{item}/forceDestroy', [adminAdministratorController::class, 'forceDestroy']);


    Route::get('/admin/pegawai', [adminPegawaiController::class, 'index']);
    Route::post('/admin/pegawai', [adminPegawaiController::class, 'store']);
    Route::get('/admin/pegawai/{item}', [adminPegawaiController::class, 'edit']);
    Route::put('/admin/pegawai/{item}', [adminPegawaiController::class, 'update']);
    Route::delete('/admin/pegawai/{item}', [adminPegawaiController::class, 'destroy']);
    Route::delete('/admin/pegawai/{item}/forceDestroy', [adminPegawaiController::class, 'forceDestroy']);



    Route::get('/admin/produk', [adminProdukController::class, 'index']);
    Route::post('/admin/produk', [adminProdukController::class, 'store']);
    Route::get('/admin/produk/{item}', [adminProdukController::class, 'edit']);
    Route::put('/admin/produk/{item}', [adminProdukController::class, 'update']);
    Route::delete('/admin/produk/{item}', [adminProdukController::class, 'destroy']);
    Route::delete('/admin/produk/{item}/forceDestroy', [adminProdukController::class, 'forceDestroy']);

    // Route::get('/admin/produk/cari', [adminProdukController::class, 'cari']);


    Route::get('/admin/label', [adminLabelController::class, 'index']);
    Route::post('/admin/label', [adminLabelController::class, 'store']);
    Route::get('/admin/label/{item}', [adminLabelController::class, 'edit']);
    Route::put('/admin/label/{item}', [adminLabelController::class, 'update']);
    Route::delete('/admin/label/{item}', [adminLabelController::class, 'destroy']);
    Route::delete('/admin/label/{item}/forceDestroy', [adminLabelController::class, 'forceDestroy']);



    Route::get('/admin/restok', [adminRestokController::class, 'index']);
    Route::post('/admin/restok', [adminRestokController::class, 'store']);
});

// AUTH DICONTROLLER

// Route::get('/admin/sekolah', [adminSekolahController::class, 'index']);
// Route::post('/admin/sekolah', [adminSekolahController::class, 'store']);
// Route::get('/admin/sekolah/{item}', [adminSekolahController::class, 'edit']);
// Route::put('/admin/sekolah/{item}', [adminSekolahController::class, 'update']);
// Route::delete('/admin/sekolah/{item}', [adminSekolahController::class, 'destroy']);
// Route::delete('/admin/sekolah/{sekolah}/forceDestroy', [adminSekolahController::class, 'forceDestroy']);
