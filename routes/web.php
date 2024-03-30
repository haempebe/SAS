<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TendikController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
});
