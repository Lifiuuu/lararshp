<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        $pets = DB::table('pet as p')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->select('p.*', 'pm.no_wa as pemilik_no_wa', 'pm.alamat as pemilik_alamat', 'r.nama_ras')
            ->where('p.idpemilik', session('user_role'))
            ->get();

        $rekamMediss = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('r.*', 't.no_urut', 'p.nama as pet_nama', 'u.nama as pemilik_nama')
            ->where('p.idpemilik', session('user_role'))
            ->get();

        $data = ['pets' => $pets, 'rekamMediss' => $rekamMediss];

        return view('pemilik.dashboard', compact('data', 'role'));
    }
}
