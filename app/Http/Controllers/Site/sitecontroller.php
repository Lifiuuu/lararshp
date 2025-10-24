<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class sitecontroller extends Controller
{
    /**
     * Menampilkan halaman Home.
     */
    public function home()
    {
        return view('site.home');
    }

    /**
     * Menampilkan halaman Struktur Organisasi.
     */
    public function strukturOrganisasi()
    {
        return view('site.struktur_organisasi');
    }

    /**
     * Menampilkan halaman Visi Misi dan Tujuan.
     */
    public function visiMisiTujuan()
    {
        return view('site.visi_misi_dan_tujuan');
    }

    /**
     * Menampilkan halaman Layanan Umum.
     */
    public function layananUmum()
    {
        return view('site.layanan_umum');

    }

    public function informasiJadwalDokterJaga()
    {
        return view('site.informasi_jadwal_dokter_jaga');
    }

    public function cekkoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'koneksi ke database berhasil !';
        } catch (\Exception $e) {
            return 'koneksi ke database gagal !' . $e->getMessage();
        }
    }
}
