<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\sitecontroller;
use App\Http\Controllers\Admin\DatauserController;
use App\Http\Controllers\Admin\DatapemilikController;
use App\Http\Controllers\Admin\DatakategoriController;
use App\Http\Controllers\Admin\DatakategoriklinisController;
use App\Http\Controllers\Admin\DatapetController;
use App\Http\Controllers\Admin\DatarekammedisController;
use App\Http\Controllers\Admin\DatatindakanController;
use App\Http\Controllers\Admin\JenishewanController;
use App\Http\Controllers\Admin\ManajemenroleController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\RashewanController;




use Illuminate\Support\Facades\Auth;

Route::get('/', [sitecontroller::class, 'home'])->name('home');

Route::get('/struktur-organisasi', [sitecontroller::class, 'strukturOrganisasi'])->name('struktur-organisasi');

Route::get('/visi-misi-tujuan', [sitecontroller::class, 'visiMisiTujuan'])->name('visi-misi-tujuan');

Route::get('/layanan-umum', [sitecontroller::class, 'layananUmum'])->name('layanan-umum');

Route::get('/informasijadwaldokterjaga', [sitecontroller::class, 'informasiJadwalDokterJaga'])->name('informasi-jadwal-dokter-jaga');

Route::get('/cekkoneksi', [sitecontroller::class, 'cekkoneksi'])->name('cekkoneksi');

Auth::routes();

Route::middleware(['administrator'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/datauser', [DatauserController::class, 'index'])->name('admin.datauser.index');
    Route::get('/admin/datapemilik', [DatapemilikController::class, 'index'])->name('admin.datapemilik.index');
    Route::get('/admin/datakategori', [DatakategoriController::class, 'index'])->name('admin.datakategori.index');
    Route::get('/admin/datakategoriklinis', [DatakategoriklinisController::class, 'index'])->name('admin.datakategoriklinis.index');
    Route::get('/admin/datapet', [DatapetController::class, 'index'])->name('admin.datapet.index');
    Route::get('/admin/datarekammedis', [DatarekammedisController::class, 'index'])->name('admin.datarekammedis.index');
    Route::get('/admin/datatindakan', [DatatindakanController::class, 'index'])->name('admin.datatindakan.index');
    Route::get('/admin/jenishewan', [JenishewanController::class, 'index'])->name('admin.jenishewan.index');
    Route::get('/admin/manajemenrole', [ManajemenroleController::class, 'index'])->name('admin.manajemenrole.index');
    Route::get('/admin/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
    Route::get('/admin/rashewan', [RashewanController::class, 'index'])->name('admin.rashewan.index');
});

Route::middleware(['dokter'])->group(function () {
    Route::get('/dokter/dashboard', [App\Http\Controllers\dokter\DashboardController::class, 'index'])->name('dokter.dashboard');
    Route::get('/dokter/datarekammedis', [App\Http\Controllers\dokter\DatarekammedisController::class, 'index'])->name('dokter.datarekammedis.index');
    Route::get('/dokter/datatindakan', [App\Http\Controllers\dokter\DatatindakanController::class, 'index'])->name('dokter.datatindakan.index');
});

Route::middleware(['perawat'])->group(function () {
    Route::get('/perawat/dashboard', [App\Http\Controllers\perawat\DashboardController::class, 'index'])->name('perawat.dashboard');
    Route::get('/perawat/datarekammedis', [App\Http\Controllers\perawat\DatarekammedisController::class, 'index'])->name('perawat.datarekammedis.index');
    Route::get('/perawat/datatindakan', [App\Http\Controllers\perawat\DatatindakanController::class, 'index'])->name('perawat.datatindakan.index');
});

Route::middleware(['resepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [App\Http\Controllers\resepsionis\DashboardController::class, 'index'])->name('resepsionis.dashboard');
    Route::get('/resepsionis/datapemilik', [App\Http\Controllers\resepsionis\DatapemilikController::class, 'index'])->name('resepsionis.datapemilik.index');
    Route::get('/resepsionis/datapet', [App\Http\Controllers\resepsionis\DatapetController::class, 'index'])->name('resepsionis.datapet.index');
    Route::get('/resepsionis/temudokter', [App\Http\Controllers\resepsionis\TemudokterController::class, 'index'])->name('resepsionis.temudokter.index');
});

Route::middleware(['pemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [App\Http\Controllers\pemilik\DashboardController::class, 'index'])->name('pemilik.dashboard');
    Route::get('/pemilik/pet', [App\Http\Controllers\pemilik\PetController::class, 'index'])->name('pemilik.pet.index');
    Route::get('/pemilik/rekammedis', [App\Http\Controllers\pemilik\DatarekammedisController::class, 'index'])->name('pemilik.rekammedis.index');
});
