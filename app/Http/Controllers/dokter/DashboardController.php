<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $roleUser = DB::table('role_user')->where('iduser', $userId)->where('idrole', 2)->first(); // 2 = Dokter
        if (!$roleUser) abort(403);

        // Stats for dokter
        $stats = [
            'rekam_medis' => DB::table('rekam_medis as r')
                ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
                ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
                ->where('t.status', '!=', 'D')
                ->count(),
            'detail_tindakan' => DB::table('detail_rekam_medis as dr')
                ->join('rekam_medis as r', 'dr.idrekam_medis', '=', 'r.idrekam_medis')
                ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
                ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
                ->where('t.status', '!=', 'D')
                ->count(),
            'temu_pending' => DB::table('temu_dokter')->where('idrole_user', $roleUser->idrole_user)->where('status', 'P')->count(),
            'total_pets' => DB::table('rekam_medis as r')
                ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
                ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
                ->distinct('t.idpet')
                ->count('t.idpet'),
        ];

        // Recent rekam medis for this dokter
        $recentRekamMediss = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->select('r.*', 't.waktu_daftar', 'p.nama as nama_pet')
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
            ->where('t.status', '!=', 'D')
            ->orderBy('t.waktu_daftar', 'desc')
            ->limit(8)
            ->get();

        return view('dokter.dashboard', compact('stats', 'recentRekamMediss'));
    }
}
