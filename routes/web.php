<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\WaktuController;

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/masuk', [HomeController::class, 'masuk'])->name('home.masuk');
Route::post('/pulang', [HomeController::class, 'pulang'])->name('home.pulang');

Route::middleware(['auth'])->group(function () {
    Route::controller(TendikController::class)->group(function () {
        Route::get('/tendik', 'index');
        Route::get('/tendik-create', 'create');
        Route::post('/tendik-create', 'store')->name('tendik.perform');
        Route::get('/tendik-edit/{id}', 'edit')->name('tendik.edit');
        Route::put('/tendik-edit/{id}', 'update')->name('tendik.update');
        Route::delete('tendik/{id}', 'destroy')->name('tendik.delete');
    });
    Route::controller(SiswaController::class)->group(function () {
        Route::get('/siswa', 'index');
        Route::get('/siswa-create', 'create');
        Route::post('/siswa-create', 'store')->name('siswa.perform');
        Route::get('/siswa-edit/{id}', 'edit')->name('siswa.edit');
        Route::put('/siswa-edit/{id}', 'update')->name('siswa.update');
        Route::delete('siswa/{id}', 'destroy')->name('siswa.delete');
    });
    Route::controller(IzinController::class)->group(function () {
        Route::get('/izin', 'index');
        Route::get('/izin-create', 'create');
        Route::post('/izin-create', 'store')->name('izin.perform');
        Route::get('/izin-edit/{id}', 'edit')->name('izin.edit');
        Route::put('/izin-edit/{id}', 'update')->name('izin.update');
        Route::delete('izin/{id}', 'destroy')->name('izin.delete');
    });
    Route::controller(WaktuController::class)->group(function () {
        Route::get('/waktu', 'index');
        Route::put('/waktu-edit/{id}', 'update')->name('waktu.update');
    });
});
