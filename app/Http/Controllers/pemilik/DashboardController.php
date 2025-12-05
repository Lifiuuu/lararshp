<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RekamMedis;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $pets = Pet::with('pemilik', 'rasHewan')->where('idpemilik', $pemilik->idpemilik)->get();

        // $pets = DB::table('pet as p')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
        //     ->select('p.*', 'pm.no_wa as pemilik_no_wa', 'pm.alamat as pemilik_alamat', 'r.nama_ras')
        //     ->where('p.idpemilik', $pemilik->idpemilik)
        //     ->get();

        $rekamMediss = RekamMedis::with('temuDokter.pet', 'temuDokter.roleUser.user')
            ->whereHas('temuDokter.pet', fn($q) => $q->where('idpemilik', $pemilik->idpemilik))
            ->get();

        // $rekamMediss = DB::table('rekam_medis as r')
        //     ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //     ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
        //     ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
        //     ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
        //     ->select('r.*', 't.no_urut', 'p.nama as pet_nama', 'u.nama as dokter_nama')
        //     ->where('p.idpemilik', $pemilik->idpemilik)
        //     ->get();

        $data = ['pets' => $pets, 'rekamMediss' => $rekamMediss];

        return view('pemilik.dashboard', compact('data', 'role'));
    }
}
