<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        // Use query builder to ensure owner names come from `user` table
        $pemiliks = DB::table('pemilik as pm')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select('pm.*', 'u.nama as user_nama', 'u.email as user_email')
            ->get();

        $pets = DB::table('pet as p')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->select('p.*', 'u.nama as pemilik_nama', 'pm.no_wa as pemilik_no_wa', 'r.nama_ras')
            ->get();

        $temudokters = DB::table('temu_dokter as t')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('t.*', 'p.nama as pet_nama', 'u.nama as pemilik_nama', 'p.idpet')
            ->get();

        $data = [
            'pemiliks' => $pemiliks,
            'pets' => $pets,
            'temudokters' => $temudokters,
        ];

        return view('resepsionis.dashboard', compact('data', 'role'));
    }
}
