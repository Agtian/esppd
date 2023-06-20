<?php

use App\Http\Controllers\Admin\DevelopmentSPPD\PelaksanaSPPDController;
use App\Http\Controllers\Admin\DevelopmentSPPD\PrintOutController;
use App\Http\Controllers\Admin\DevelopmentSPPD\SppdController;
use App\Http\Controllers\Admin\Master\GolPegawaiController;
use App\Http\Controllers\Admin\Master\InstalasiController;
use App\Http\Controllers\Admin\Master\JabatanController;
use App\Http\Controllers\Admin\Master\KelompokPegawaiController;
use App\Http\Controllers\Admin\Master\KonfigurasiSPPDController;
use App\Http\Controllers\Admin\Master\PangkatController;
use App\Http\Controllers\Admin\Master\PegawaiController;
use App\Http\Controllers\Admin\Master\PendidikanController;
use App\Http\Controllers\Admin\Master\PendidikanKualifikasiController;
use App\Http\Controllers\Admin\Master\UnitKerjaController;
use App\Http\Controllers\Admin\Report\BiayaController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard/dashboard-v1', [App\Http\Controllers\Dashboard\DashboardV1::class, 'index'])->name('dashboard-v1');
Route::get('/dashboard/dashboard-v2', [App\Http\Controllers\Dashboard\DashboardV2::class, 'index'])->name('dashboard-v2');
Route::get('/dashboard/dashboard-v3', [App\Http\Controllers\Dashboard\DashboardV3::class, 'index'])->name('dashboard-v3');

Route::controller(PrintOutController::class)->group(function () {
    Route::get('/printout/surat-tugas-i/{perjalanandinas_id}', 'suratTugasKurangDari4Orang');
    Route::get('/printout/sppd/{perjalanandinas_id}', 'suratSPPD');
    Route::get('/printout/rincian-biaya-i/{perjalanandinas_id}', 'rincianBiayaI');
    
    Route::get('/printout/surat-tugas-ii/{perjalanandinas_id}', 'suratTugasLebihDari4Orang');
    Route::get('/printout/sppd-iii/{perjalanandinas_id}', 'suratSPPDLebihDari4Orang');
    Route::get('/printout/rincian-biaya-ii/{perjalanandinas_id}', 'rincianBiayaLebihDari4Orang');
});

Route::prefix('dashboard/admin')->middleware(['auth', 'isAdmin'])->group(function () {

    Route::controller(SppdController::class)->group(function () {
        Route::get('/sppd', 'index');
        Route::get('/sppd/create', 'create');
        Route::post('/sppd', 'store');
        Route::get('/sppd/{sppd}/edit', 'edit');
        Route::put('/sppd/{sppd}', 'update');
        Route::get('/sppd/{sppd}/delete', 'destroy');

        Route::get('/sppd/autocomplete-get-pegawai', 'getPegawai');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/create', 'create');
        Route::post('/user', 'store');
        Route::get('/user/{user}/edit', 'edit');
        Route::put('/user/{user}', 'update');
        Route::get('/user/{user}/delete', 'destroy');
    });

    Route::controller(PegawaiController::class)->group(function () {
        Route::get('/pegawai', 'index');
        Route::get('/pegawai/create', 'create');
        Route::post('/pegawai', 'store');
        Route::get('/pegawai/{pegawai}/edit', 'edit');
        Route::put('/pegawai/{pegawai}', 'update');
        Route::get('/pegawai/{pegawai}/delete', 'destroy');
    });

    Route::controller(BiayaController::class)->group(function () {
        Route::get('/biaya-sppd', 'index');
        Route::get('/biaya-sppd/{id}/edit', 'edit');
        Route::post('/biaya-sppd-filter', 'filterData');
    });

    Route::controller(PelaksanaSPPDController::class)->group(function () {
        Route::get('/pelaksana-sppd', 'index');
    });

    Route::controller(GolPegawaiController::class)->group(function () {
        Route::get('/golongan-pegawai', 'index');
    });
    
    Route::controller(InstalasiController::class)->group(function () {
        Route::get('/instalasi', 'index');
    });
    
    Route::controller(JabatanController::class)->group(function () {
        Route::get('/jabatan', 'index');
    });
    
    Route::controller(KelompokPegawaiController::class)->group(function () {
        Route::get('/kelompok-pegawai', 'index');
    });
    
    Route::controller(KonfigurasiSPPDController::class)->group(function () {
        Route::get('/konfigurasi-sppd', 'index');
    });
    
    Route::controller(PangkatController::class)->group(function () {
        Route::get('/pangkat', 'index');
    });
    
    Route::controller(PendidikanController::class)->group(function () {
        Route::get('/pendidikan', 'index');
    });

    Route::controller(PendidikanKualifikasiController::class)->group(function () {
        Route::get('/pendidikan-kualifikasi', 'index');
    });
    
    Route::controller(UnitKerjaController::class)->group(function () {
        Route::get('/unit-kerja', 'index');
    });
});