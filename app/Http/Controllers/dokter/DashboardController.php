<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        $rekamMediss = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('r.*', 't.no_urut', 'p.nama as pet_nama', 'u.nama as pemilik_nama')
            ->get();

        $tindakans = DB::table('kode_tindakan_terapi as k')
            ->leftJoin('kategori as kat', 'k.idkategori', '=', 'kat.idkategori')
            ->leftJoin('kategori_klinis as kk', 'k.idkategori_klinis', '=', 'kk.idkategori_klinis')
            ->select('k.*', 'kat.nama_kategori', 'kk.nama_kategori_klinis')
            ->get();

        $data = ['rekamMediss' => $rekamMediss, 'tindakans' => $tindakans];

        return view('dokter.dashboard', compact('data', 'role'));
    }
}
