<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\RoleUser;
use Carbon\Carbon;

class DatarekammedisController extends Controller
{
    public function index()
    {
        // Get current user role_user id
        $userId = Auth::id();
        $roleUser = RoleUser::where('iduser', $userId)->where('idrole', 2)->first(); // 2 = Dokter
        if (!$roleUser) abort(403);

        $rekamMediss = RekamMedis::join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('rekam_medis.dokter_pemeriksa', $roleUser->idrole_user)
            ->where('temu_dokter.status', '=', 'P')
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today()->toDateString())
            ->orderBy('temu_dokter.waktu_daftar', 'asc')
            ->select('rekam_medis.*')
            ->with('temuDokter.pet.pemilik.user', 'roleUser.user')
            ->whereHas('temuDokter.pet.pemilik.user', fn($q) => $q->whereNull('deleted_at'))
            ->get();
        // $rekamMediss = DB::table('rekam_medis as r')
        //     ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //     ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('user as u_owner', 'pm.iduser', '=', 'u_owner.iduser')
        //     ->leftJoin('role_user as ru_doc', 'r.dokter_pemeriksa', '=', 'ru_doc.idrole_user')
        //     ->leftJoin('user as u_doc', 'ru_doc.iduser', '=', 'u_doc.iduser')
        //     ->select(
        //         'r.*',
        //         't.no_urut',
        //         't.waktu_daftar',
        //         'p.nama as nama_pet',
        //         'u_owner.nama as nama_pemilik',
        //         'pm.no_wa as pemilik_no_wa',
        //         'u_doc.nama as nama_dokter'
        //     )
        //     ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
        //     ->where('t.status', '!=', 'D')
        //     ->orderBy('t.waktu_daftar', 'desc')
        //     ->get();

        return view('dokter.datarekammedis.index', compact('rekamMediss'));
    }

    public function complete($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        // $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        // if (!$rekam) abort(404);

        // Update temu_dokter status to 'D'
        $rekam->temuDokter->update(['status' => 'D']);
        // DB::table('temu_dokter')->where('idreservasi_dokter', $rekam->idreservasi_dokter)->update(['status' => 'D']);

        return redirect()->route('dokter.datarekammedis.index')->with('success', 'Temu dokter diselesaikan.');
    }
}
