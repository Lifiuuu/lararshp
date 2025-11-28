<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $rekamMediss = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('r.*', 't.no_urut', 't.waktu_daftar', 'p.nama as pet_nama', 'p.idpemilik', 'u.nama as dokter_nama')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->get();

        return view('pemilik.rekammedis.index', compact('rekamMediss'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('r.*', 't.no_urut', 't.waktu_daftar', 'p.nama as pet_nama', 'p.idpemilik', 'u.nama as dokter_nama')
            ->where('r.idrekam_medis', $id)
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->first();

        if (!$rekamMedis) {
            return redirect()->route('pemilik.rekammedis.index')->with('error', 'Rekam medis tidak ditemukan.');
        }

        $detailRekamMedis = DB::table('detail_rekam_medis as dr')
            ->leftJoin('kode_tindakan_terapi as ktt', 'dr.idkode_tindakan_terapi', '=', 'ktt.idkode_tindakan_terapi')
            ->leftJoin('kategori as kat', 'ktt.idkategori', '=', 'kat.idkategori')
            ->leftJoin('kategori_klinis as kk', 'ktt.idkategori_klinis', '=', 'kk.idkategori_klinis')
            ->select('dr.*', 'ktt.kode', 'ktt.deskripsi_tindakan_terapi', 'kat.nama_kategori', 'kk.nama_kategori_klinis')
            ->where('dr.idrekam_medis', $id)
            ->get();

        return view('pemilik.rekammedis.show', compact('rekamMedis', 'detailRekamMedis'));
    }
}
