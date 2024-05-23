<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RekapAbsenSiswaController;
use App\Http\Controllers\RekapAbsenTendikController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TendikController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\SilatController;
use App\Http\Controllers\FutsalController;
use App\Http\Controllers\PramukaController;
use App\Http\Controllers\KodingController;
use App\Http\Controllers\RobotikController;

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
        Route::get('/tendik', 'index')->name('tendik');
        Route::get('/tendik-create', 'create');
        Route::post('/tendik-create', 'store')->name('tendik.perform');
        Route::post('/tendik-import', 'importTendik')->name('tendik.import');
        Route::get('/tendik-edit/{id}', 'edit')->name('tendik.edit');
        Route::put('/tendik-edit/{id}', 'update')->name('tendik.update');
        Route::delete('tendik/{id}', 'destroy')->name('tendik.delete');
    });
    Route::controller(SiswaController::class)->group(function () {
        Route::get('/siswa', 'index')->name('siswa');
        Route::get('/siswa-cari', 'siswaFilter')->name('siswa.filter');
        Route::get('/siswa-create', 'create');
        Route::post('/siswa-create', 'store')->name('siswa.perform');
        Route::post('/siswa-import', 'importSiswa')->name('siswa.import');
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
    Route::controller(RekapAbsenSiswaController::class)->group(function () {
        Route::get('/rekap-siswa', 'index')->name('rekap-siswa');
        Route::get('/filter-siswa', 'filter');
        Route::get('/filter-siswa/pdf', 'pdf');
    });
    Route::controller(RekapAbsenTendikController::class)->group(function () {
        Route::get('/rekap-tendik', 'index')->name('rekap-tendik');
        Route::get('/filter-tendik', 'filter');
        Route::get('/filter-tendik/pdf', 'pdf');
    });
    Route::controller(WaktuController::class)->group(function () {
        Route::get('/waktu', 'index');
        Route::put('/waktu-edit/{id}', 'update')->name('waktu.update');
    });
    Route::controller(SilatController::class)->group(function () {
        Route::get('/silat', 'index')->name('silat');
        Route::get('/silat-create', 'create');
        Route::post('/silat-create', 'store')->name('silat.perform');
        Route::get('/silat-edit/{id}', 'edit')->name('silat.edit');
        Route::put('/silat-edit/{id}', 'update')->name('silat.update');
        Route::delete('silat/{id}', 'destroy')->name('silat.delete');
    });
    Route::controller(FutsalController::class)->group(function () {
        Route::get('/futsal', 'index')->name('futsal');
        Route::get('/futsal-create', 'create');
        Route::post('/futsal-create', 'store')->name('futsal.perform');
        Route::get('/futsal-edit/{id}', 'edit')->name('futsal.edit');
        Route::put('/futsal-edit/{id}', 'update')->name('futsal.update');
        Route::delete('futsal/{id}', 'destroy')->name('futsal.delete');
    });
    Route::controller(PramukaController::class)->group(function () {
        Route::get('/pramuka', 'index')->name('pramuka');
        Route::get('/pramuka-create', 'create');
        Route::post('/pramuka-create', 'store')->name('pramuka.perform');
        Route::get('/pramuka-edit/{id}', 'edit')->name('pramuka.edit');
        Route::put('/pramuka-edit/{id}', 'update')->name('pramuka.update');
        Route::delete('pramuka/{id}', 'destroy')->name('pramuka.delete');
    });
    Route::controller(KodingController::class)->group(function () {
        Route::get('/koding', 'index')->name('koding');
        Route::get('/koding-create', 'create');
        Route::post('/koding-create', 'store')->name('koding.perform');
        Route::get('/koding-edit/{id}', 'edit')->name('koding.edit');
        Route::put('/koding-edit/{id}', 'update')->name('koding.update');
        Route::delete('koding/{id}', 'destroy')->name('koding.delete');
    });
    Route::controller(RobotikController::class)->group(function () {
        Route::get('/robotik', 'index')->name('robotik');
        Route::get('/robotik-create', 'create');
        Route::post('/robotik-create', 'store')->name('robotik.perform');
        Route::get('/robotik-edit/{id}', 'edit')->name('robotik.edit');
        Route::put('/robotik-edit/{id}', 'update')->name('robotik.update');
        Route::delete('robotik/{id}', 'destroy')->name('robotik.delete');
    });
});
