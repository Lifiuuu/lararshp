<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\RekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\TemuDokter;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');

        // Only include Rekam Medis with temuDokter scheduled today and not deleted
        $rekamMediss = RekamMedis::with('temuDokter.pet.pemilik.user', 'roleUser.user')
            ->whereHas('temuDokter', function($q) {
                $q->where('status', '!=', 'D')
                  ->whereDate('waktu_daftar', Carbon::today()->toDateString());
            })
            ->get()
            ->sortByDesc(function($r) { return optional($r->temuDokter)->waktu_daftar ?? $r->created_at; })
            ->values();

        // $rekamMediss = DB::table('rekam_medis as r')
        //     ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //     ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('user as u_owner', 'pm.iduser', '=', 'u_owner.iduser')
        //     // doctor who examined
        //     ->leftJoin('role_user as ru_doc', 'r.dokter_pemeriksa', '=', 'ru_doc.idrole_user')
        //     ->leftJoin('user as u_doc', 'ru_doc.iduser', '=', 'u_doc.iduser')
        //     ->select('r.*', 't.no_urut', 't.waktu_daftar', 'p.nama as nama_pet', 'u_doc.nama as nama_dokter', 'u_owner.nama as nama_pemilik')
        //     ->where('t.status', '!=', 'D')
        //     ->get();

        $tindakans = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();

        // $tindakans = DB::table('kode_tindakan_terapi as k')
        //     ->leftJoin('kategori as kat', 'k.idkategori', '=', 'kat.idkategori')
        //     ->leftJoin('kategori_klinis as kk', 'k.idkategori_klinis', '=', 'kk.idkategori_klinis')
        //     ->select('k.*', 'kat.nama_kategori', 'kk.nama_kategori_klinis')
        //     ->get();

        $data = ['rekamMediss' => $rekamMediss, 'tindakans' => $tindakans];

        // Summary stats
        $stats = [
            'patients' => \App\Models\Pet::count(),
            'rekam_medis' => RekamMedis::whereHas('temuDokter', fn($q) => $q->where('status', '=', 'P')->whereDate('waktu_daftar', Carbon::today()->toDateString()))->count(),
        ];

        // // Summary stats
        // $stats = [
        //     'patients' => DB::table('pet')->count(),
        //     'rekam_medis' => DB::table('rekam_medis as r')
        //         ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        //         ->where('t.status', '!=', 'D')
        //         ->count(),
        // ];

        // Monthly visits for last 6 months (based on temu_dokter.waktu_daftar)
        $start = Carbon::now()->startOfMonth()->subMonths(5)->toDateString();
        $monthlyVisits = TemuDokter::selectRaw("DATE_FORMAT(waktu_daftar, '%Y-%m') as month, COUNT(*) as total")
            ->where('waktu_daftar', '>=', $start)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Pet distribution by ras
        $petByRas = Pet::leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->select('ras_hewan.nama_ras', DB::raw('COUNT(*) as total'))
            ->groupBy('ras_hewan.idras_hewan', 'ras_hewan.nama_ras')
            ->orderBy('total', 'desc')
            ->get();

        // Prepare arrays/CSV for charts
        $monthlyLabels = $monthlyVisits->pluck('month')->map(function ($m) { return (string) $m; })->toArray();
        $monthlyTotals = $monthlyVisits->pluck('total')->map(function ($v) { return (int) $v; })->toArray();

        $petLabels = $petByRas->pluck('nama_ras')->map(function ($s) { return (string) $s; })->toArray();
        $petValues = $petByRas->pluck('total')->map(function ($v) { return (int) $v; })->toArray();

        $monthlyLabelsCsv = implode('|', $monthlyLabels);
        $monthlyTotalsCsv = implode(',', $monthlyTotals);
        $petLabelsCsv = implode('|', array_map(function ($s) { return str_replace('|', '-', $s); }, $petLabels));
        $petValuesCsv = implode(',', $petValues);

        return view('perawat.dashboard', compact(
            'data', 'role', 'stats',
            'monthlyLabelsCsv', 'monthlyTotalsCsv', 'petLabelsCsv', 'petValuesCsv'
        ));
    }
}
