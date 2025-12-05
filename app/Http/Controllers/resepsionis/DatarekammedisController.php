<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $rekamMediss = RekamMedis::with('temuDokter.pet', 'temuDokter.roleUser.user')->get();

        // $rekamMediss = DB::table('rekam_medis as r')
        //     ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //     ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
        //     ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
        //     ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
        //     ->select('r.*', 't.no_urut', 't.waktu_daftar', 'p.nama as pet_nama', 'u.nama as pemilik_nama')
        //     ->get();

        return view('resepsionis.datarekammedis.index', compact('rekamMediss'));
    }

    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();

        // $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        // if (!$rekam) abort(404);
        // DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();

        return redirect()->route('resepsionis.datarekammedis.index')->with('success', 'Rekam medis dihapus.');
    }
}
