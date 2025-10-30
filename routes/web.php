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

Route::get('/datauser', [DatauserController::class, 'index'])->name('admin.datauser.index');

Route::get('/datapemilik', [DatapemilikController::class, 'index'])->name('admin.datapemilik.index');

Route::get('/datakategori', [DatakategoriController::class, 'index'])->name('admin.datakategori.index');

Route::get('/datakategoriklinis', [DatakategoriklinisController::class, 'index'])->name('admin.datakategoriklinis.index');

Route::get('/datapet', [DatapetController::class, 'index'])->name('admin.datapet.index');

Route::get('/datarekammedis', [DatarekammedisController::class, 'index'])->name('admin.datarekammedis.index');

Route::get('/datatindakan', [DatatindakanController::class, 'index'])->name('admin.datatindakan.index');

Route::get('/jenishewan', [JenishewanController::class, 'index'])->name('admin.jenishewan.index');

Route::get('/manajemenrole', [ManajemenroleController::class, 'index'])->name('admin.manajemenrole.index');

Route::get('/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');

Route::get('/rashewan', [RashewanController::class, 'index'])->name('admin.rashewan.index');


