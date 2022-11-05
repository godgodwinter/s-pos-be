<?php

use App\Http\Controllers\admin\adminSettingsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('/admin/auth/login', [AuthController::class, 'login'])->name('admin.auth.login');
// Route::post('/admin/auth/register', [AuthController::class, 'register'])->name('admin.auth.register');
// Route::middleware('api')->group(function () {
Route::middleware('auth:api')->group(function () {




    //menu-portofolio
    Route::post('/admin/auth/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    Route::post('/admin/auth/refresh', [AuthController::class, 'refresh'])->name('admin.auth.refresh');
    Route::post('/admin/auth/me', [AuthController::class, 'me'])->name('admin.auth.me');

    Route::get('/admin/settings/get', [adminSettingsController::class, 'index'])->name('admin.settings.get');
});

// AUTH DICONTROLLER

// Route::get('/admin/sekolah', [adminSekolahController::class, 'index']);
// Route::post('/admin/sekolah', [adminSekolahController::class, 'store']);
// Route::get('/admin/sekolah/{item}', [adminSekolahController::class, 'edit']);
// Route::put('/admin/sekolah/{item}', [adminSekolahController::class, 'update']);
// Route::delete('/admin/sekolah/{item}', [adminSekolahController::class, 'destroy']);
// Route::delete('/admin/sekolah/{sekolah}/forceDestroy', [adminSekolahController::class, 'forceDestroy']);
