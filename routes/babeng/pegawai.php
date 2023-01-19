<?php

use App\Http\Controllers\AuthPegawaiController;
use Illuminate\Support\Facades\Route;



Route::post('/pegawai/auth/login', [AuthPegawaiController::class, 'login']);
Route::middleware('babeng:adminPegawai')->group(function () {


    // Route::post('/siswa/auth/register', [AuthSiswaController::class, 'register'])->name('siswa.auth.register');
    Route::post('/pegawai/auth/logout', [AuthPegawaiController::class, 'logout']);
    Route::post('/pegawai/auth/refresh', [AuthPegawaiController::class, 'refresh']);
    Route::post('/pegawai/auth/me', [AuthPegawaiController::class, 'me']);
    Route::post("pegawai/auth/profile", [AuthPegawaiController::class, 'refresh']);
    Route::post("pegawai/auth/profile/update", [AuthPegawaiController::class, 'update']);
});
