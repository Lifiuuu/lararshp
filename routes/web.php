<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\sitecontroller;


use Illuminate\Support\Facades\Auth;

Route::get('/', [sitecontroller::class, 'home'])->name('home');

Route::get('/struktur-organisasi', [sitecontroller::class, 'strukturOrganisasi'])->name('struktur-organisasi');

Route::get('/visi-misi-tujuan', [sitecontroller::class, 'visiMisiTujuan'])->name('visi-misi-tujuan');

Route::get('/layanan-umum', [sitecontroller::class, 'layananUmum'])->name('layanan-umum');

Route::get('/informasijadwaldokterjaga', [sitecontroller::class, 'informasiJadwalDokterJaga'])->name('informasi-jadwal-dokter-jaga');

Route::get('/cekkoneksi', [sitecontroller::class, 'cekkoneksi'])->name('cekkoneksi');

Auth::routes();

Route::prefix('admin')->name('admin.')->middleware(['administrator'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('datauser', App\Http\Controllers\Admin\DatauserController::class);
    Route::resource('datapemilik', App\Http\Controllers\Admin\DatapemilikController::class);
    Route::resource('datakategori', App\Http\Controllers\Admin\DatakategoriController::class);
    Route::resource('datakategoriklinis', App\Http\Controllers\Admin\DatakategoriklinisController::class);
    Route::resource('datapet', App\Http\Controllers\Admin\DatapetController::class);
    Route::resource('datarekammedis', App\Http\Controllers\Admin\DatarekammedisController::class);
    Route::resource('datatindakan', App\Http\Controllers\Admin\DatatindakanController::class);
    Route::get('detailrekammedis/create/{idrekam}', [App\Http\Controllers\Admin\DetailrekammedisController::class, 'create'])->name('detailrekammedis.create');
    Route::resource('detailrekammedis', App\Http\Controllers\Admin\DetailrekammedisController::class)->except(['create']);
    Route::resource('temudokter', App\Http\Controllers\Admin\TemudokterController::class);
    Route::resource('jenishewan', App\Http\Controllers\Admin\JenishewanController::class);
    Route::resource('manajemenrole', App\Http\Controllers\Admin\ManajemenroleController::class);
    Route::resource('pemilik', App\Http\Controllers\Admin\PemilikController::class);
    Route::resource('rashewan', App\Http\Controllers\Admin\RashewanController::class);
    Route::resource('datadokter', App\Http\Controllers\Admin\DokterController::class);
    Route::resource('dataperawat', App\Http\Controllers\Admin\PerawatController::class);
});

Route::prefix('dokter')->name('dokter.')->middleware(['dokter'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\dokter\DashboardController::class, 'index'])->name('dashboard');

    // Rekam Medis and tindakan for dokter (resourceful)
    Route::resource('datarekammedis', App\Http\Controllers\dokter\DatarekammedisController::class);
    Route::post('datarekammedis/{id}/complete', [App\Http\Controllers\dokter\DatarekammedisController::class, 'complete'])->name('datarekammedis.complete');
    Route::resource('datatindakan', App\Http\Controllers\dokter\DatatindakanController::class);
    // Detail Rekam Medis (CRUD) for dokter
    Route::get('detailrekammedis/create/{idrekam}', [App\Http\Controllers\dokter\DetailRekamMedisController::class, 'create'])->name('detailrekammedis.create');
    Route::resource('detailrekammedis', App\Http\Controllers\dokter\DetailRekamMedisController::class)->except(['create', 'show']);

    // Profile
    Route::get('/profile/edit', [App\Http\Controllers\dokter\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\dokter\ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('perawat')->name('perawat.')->middleware(['perawat'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\perawat\DashboardController::class, 'index'])->name('dashboard');

    // Pasien (datapet with owner) for perawat
    Route::resource('datapasien', App\Http\Controllers\perawat\DatapasienController::class);

    // Rekam Medis and tindakan for perawat
    Route::resource('datarekammedis', App\Http\Controllers\perawat\DatarekammedisController::class);
    Route::resource('datatindakan', App\Http\Controllers\perawat\DatatindakanController::class);
    // Detail Rekam Medis for perawat (view details)
    Route::resource('detailrekammedis', App\Http\Controllers\perawat\DetailRekamMedisController::class)->only(['show']);

    // Profile
    Route::get('/profile/edit', [App\Http\Controllers\perawat\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\perawat\ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('resepsionis')->name('resepsionis.')->middleware(['resepsionis'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\resepsionis\DashboardController::class, 'index'])->name('dashboard');

    // Pemilik, pet and temu dokter resources for resepsionis
    Route::resource('datapemilik', App\Http\Controllers\resepsionis\DatapemilikController::class);
    Route::resource('datapet', App\Http\Controllers\resepsionis\DatapetController::class);
    Route::resource('datarekammedis', App\Http\Controllers\resepsionis\DatarekammedisController::class);
    Route::resource('temudokter', App\Http\Controllers\resepsionis\TemudokterController::class);
});

Route::prefix('pemilik')->name('pemilik.')->middleware(['pemilik'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\pemilik\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pet', [App\Http\Controllers\pemilik\PetController::class, 'index'])->name('pet.index');
    Route::get('/rekammedis', [App\Http\Controllers\pemilik\DatarekammedisController::class, 'index'])->name('rekammedis.index');
    Route::get('/rekammedis/{id}', [App\Http\Controllers\pemilik\DatarekammedisController::class, 'show'])->name('rekammedis.show');

    // Profile
    Route::get('/profile/edit', [App\Http\Controllers\pemilik\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\pemilik\ProfileController::class, 'update'])->name('profile.update');
});
