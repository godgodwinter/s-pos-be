<?php

use App\Http\Controllers\AuthOwnerController;
use Illuminate\Support\Facades\Route;



Route::post('/pegawai/auth/login', [AuthOwnerController::class, 'login']);
Route::middleware('auth:pegawai')->group(function () {


    // Route::post('/siswa/auth/register', [AuthSiswaController::class, 'register'])->name('siswa.auth.register');
    Route::post('/pegawai/auth/logout', [AuthOwnerController::class, 'logout']);
    Route::post('/pegawai/auth/refresh', [AuthOwnerController::class, 'refresh']);
    Route::post('/pegawai/auth/me', [AuthOwnerController::class, 'me']);


    // Route::get('/owner/menuujian/banksoal', [adminUjianBankSoalController::class, 'index']);
    // Route::post('/owner/menuujian/banksoal', [adminUjianBankSoalController::class, 'store']);
    // Route::get('/owner/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'edit']);
    // Route::put('/owner/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'update']);
    // Route::delete('/owner/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'destroy']);
});
