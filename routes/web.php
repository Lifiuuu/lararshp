<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\sitecontroller;
use App\Http\Controllers\Admin\DatauserController;


use Illuminate\Support\Facades\Auth;

Route::get('/', [sitecontroller::class, 'home'])->name('home');

Route::get('/struktur-organisasi', [sitecontroller::class, 'strukturOrganisasi'])->name('struktur-organisasi');

Route::get('/visi-misi-tujuan', [sitecontroller::class, 'visiMisiTujuan'])->name('visi-misi-tujuan');

Route::get('/layanan-umum', [sitecontroller::class, 'layananUmum'])->name('layanan-umum');

Route::get('/informasijadwaldokterjaga', [sitecontroller::class, 'informasiJadwalDokterJaga'])->name('informasi-jadwal-dokter-jaga');

Route::get('/cekkoneksi', [sitecontroller::class, 'cekkoneksi'])->name('cekkoneksi');

Route::get('/datauser', [DatauserController::class, 'index'])->name('admin.datauser.index');
