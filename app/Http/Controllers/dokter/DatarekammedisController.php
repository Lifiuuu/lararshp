<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $rekamMediss = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('r.*', 't.no_urut', 't.waktu_daftar', 'p.nama as pet_nama', 'p.idpet', 'u.nama as pemilik_nama')
            ->get();

        return view('admin.datarekammedis.index', compact('rekamMediss'));
    }
}
