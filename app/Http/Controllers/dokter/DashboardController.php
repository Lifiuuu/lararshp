<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\TemuDokter;
use App\Models\RoleUser;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $roleUser = RoleUser::where('iduser', $userId)->where('idrole', 2)->first(); // 2 = Dokter
        if (!$roleUser) abort(403);

        // Stats for dokter
        $stats = [
            'rekam_medis' => RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)
                ->whereHas('temuDokter', fn($q) => $q->where('status', '!=', 'D'))
                ->count(),
            'detail_tindakan' => DetailRekamMedis::whereHas('rekamMedis', function($q) use ($roleUser) {
                $q->where('dokter_pemeriksa', $roleUser->idrole_user)
                  ->whereHas('temuDokter', fn($qq) => $qq->where('status', '!=', 'D'));
            })->count(),
            'temu_pending' => TemuDokter::where('idrole_user', $roleUser->idrole_user)->where('status', 'P')->count(),
            'total_pets' => RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)
                ->with('temuDokter')
                ->get()
                ->pluck('temuDokter.idpet')
                ->unique()
                ->count(),
        ];

        // // Stats for dokter
        // $stats = [
        //     'rekam_medis' => DB::table('rekam_medis as r')
        //         ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //         ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
        //         ->where('t.status', '!=', 'D')
        //         ->count(),
        //     'detail_tindakan' => DB::table('detail_rekam_medis as dr')
        //         ->join('rekam_medis as r', 'dr.idrekam_medis', '=', 'r.idrekam_medis')
        //         ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //         ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
        //         ->where('t.status', '!=', 'D')
        //         ->count(),
        //     'temu_pending' => DB::table('temu_dokter')->where('idrole_user', $roleUser->idrole_user)->where('status', 'P')->count(),
        //     'total_pets' => DB::table('rekam_medis as r')
        //         ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //         ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
        //         ->distinct('t.idpet')
        //         ->count('t.idpet'),
        // ];

        // Recent rekam medis for this dokter
        $recentRekamMediss = RekamMedis::join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('rekam_medis.dokter_pemeriksa', $roleUser->idrole_user)
            ->where('temu_dokter.status', '!=', 'D')
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today()->toDateString())
            ->orderBy('temu_dokter.waktu_daftar', 'desc')
            ->select('rekam_medis.*')
            ->limit(8)
            ->with('temuDokter.pet')
            ->get();

        // // Recent rekam medis for this dokter
        // $recentRekamMediss = RekamMedis::with('temuDokter.pet')
        //     ->where('dokter_pemeriksa', $roleUser->idrole_user)
        //     ->whereHas('temuDokter', fn($q) => $q->where('status', '!=', 'D'))
        //     ->orderBy('temuDokter.waktu_daftar', 'desc')
        //     ->limit(8)
        //     ->get();

        return view('dokter.dashboard', compact('stats', 'recentRekamMediss'));
    }
}
