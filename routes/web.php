<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RsvpController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/konfirmasi', [KehadiranController::class, 'index']);
Route::get('/detail', [KehadiranController::class, 'detail'])->name('kehadiran.detail');

Route::resource('kelas', KelasController::class);
Route::resource('siswa', SiswaController::class);
Route::resource('sesi', SesiController::class);
Route::resource('kehadiran', KehadiranController::class);
Route::put('/kehadiran/{id}', [KehadiranController::class, 'update'])
    ->name('kehadiran.update');
Route::post('/kehadiran', [KehadiranController::class, 'storeOrUpdate'])
    ->name('kehadiran.storeOrUpdate');
Route::get('/rsvp/{token}', [RsvpController::class, 'create'])
    ->name('rsvp.create');

Route::post('/rsvp', [RsvpController::class, 'store'])->name('rsvp.store');
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard/kehadiran/{sesi}', [DashboardController::class, 'detail'])
    ->name('dashboard.kehadiran.detail');
