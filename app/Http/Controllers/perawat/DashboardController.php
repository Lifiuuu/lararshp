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
       $rekamMediss = RekamMedis::join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('temu_dokter.status', '!=', 'B')
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today()->toDateString())
            ->orderBy('temu_dokter.waktu_daftar', 'asc')
            ->select('rekam_medis.*')
            ->with('temuDokter.pet.pemilik.user', 'roleUser.user')
            ->whereHas('temuDokter.pet.pemilik.user', fn($q) => $q->whereNull('deleted_at'))
            ->get()
            ->sortByDesc(function($r) { return optional($r->temuDokter)->waktu_daftar ?? $r->created_at; })
            ->values();


        $tindakans = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')
            ->whereHas('kategori', fn($q) => $q->whereNull('deleted_at'))
            ->whereHas('kategoriKlinis', fn($q) => $q->whereNull('deleted_at'))
            ->get();

  

        $data = ['rekamMediss' => $rekamMediss, 'tindakans' => $tindakans];

        // Summary stats
        $stats = [
            'patients' => Pet::count(),
            'rekam_medis' => 
            $rekamMediss = RekamMedis::join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('temu_dokter.status', '!=', 'B')
            ->whereDate('temu_dokter.waktu_daftar', Carbon::today()->toDateString())
            ->orderBy('temu_dokter.waktu_daftar', 'asc')
            ->select('rekam_medis.*')
            ->with('temuDokter.pet.pemilik.user', 'roleUser.user')
            ->whereHas('temuDokter.pet.pemilik.user', fn($q) => $q->whereNull('deleted_at'))
            ->count(),
        ];

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
