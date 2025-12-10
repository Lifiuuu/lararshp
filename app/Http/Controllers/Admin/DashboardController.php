<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Role;
use App\Models\DataUser;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\Dokter;
use App\Models\Perawat;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');
        $data = [
            'kategoris' => Kategori::whereNull('deleted_at')->get(),
            'kategoriKliniss' => KategoriKlinis::whereNull('deleted_at')->get(),
            'jenisHewans' => JenisHewan::whereNull('deleted_at')->get(),
            'rasHewans' => RasHewan::with('jenisHewan')->whereHas('jenisHewan', fn($q) => $q->whereNull('deleted_at'))->get(),
            'roles' => Role::whereNull('deleted_at')->get(),
            'users' => DB::table('user')
                ->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')
                ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
                ->leftJoin('pemilik', 'user.iduser', '=', 'pemilik.iduser')
                ->whereNull('user.deleted_at')
                ->select('user.*', 'role.nama_role', 'pemilik.idpemilik', 'pemilik.no_wa as pemilik_no_wa', 'pemilik.alamat')
                ->get(),
            'pemiliks' => Pemilik::with('user')->whereHas('user', fn($q) => $q->whereNull('deleted_at'))->get(),
            'pets' => Pet::with('pemilik.user', 'rasHewan')
                ->whereHas('pemilik.user', fn($q) => $q->whereNull('deleted_at'))
                ->whereHas('rasHewan.jenisHewan', fn($q) => $q->whereNull('deleted_at'))
                ->get(),
            'rekamMediss' => RekamMedis::with('temuDokter.pet', 'roleUser.user')
                ->whereHas('temuDokter', function($q) {
                    $q->where('status', '!=', 'D')
                      ->whereDate('waktu_daftar', Carbon::today()->toDateString());
                })
                ->whereHas('temuDokter.pet.pemilik.user', fn($q) => $q->whereNull('deleted_at'))
                ->whereHas('roleUser.user', fn($q) => $q->whereNull('deleted_at'))
                ->get()->sortByDesc(function($r) { return optional($r->temuDokter)->waktu_daftar ?? $r->created_at; })->values(),
            'tindakans' => KodeTindakanTerapi::with('kategori', 'kategoriKlinis')
                ->whereHas('kategori', fn($q) => $q->whereNull('deleted_at'))
                ->whereHas('kategoriKlinis', fn($q) => $q->whereNull('deleted_at'))
                ->get()
        ];

        // Summary counts
        $stats = [
            'users' => DataUser::whereNull('deleted_at')->count(),
            'pets' => Pet::whereHas('pemilik.user', fn($q) => $q->whereNull('deleted_at'))
                ->whereHas('rasHewan.jenisHewan', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
            'rekam_medis' => RekamMedis::whereHas('temuDokter.pet.pemilik.user', fn($q) => $q->whereNull('deleted_at'))
                ->whereHas('roleUser.user', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
            'tindakans' => KodeTindakanTerapi::whereHas('kategori', fn($q) => $q->whereNull('deleted_at'))
                ->whereHas('kategoriKlinis', fn($q) => $q->whereNull('deleted_at'))
                ->count(),
            'dokters' => Dokter::whereHas('user', fn($q) => $q->whereNull('deleted_at'))->count(),
            'perawats' => Perawat::whereHas('user', fn($q) => $q->whereNull('deleted_at'))->count(),
        ];

        // Monthly registrations / visits for the last 6 months (based on waktu_daftar)
        $start = Carbon::now()->startOfMonth()->subMonths(5)->toDateString();
        $monthlyVisits = DB::table('temu_dokter')
            ->selectRaw("DATE_FORMAT(waktu_daftar, '%Y-%m') as month, COUNT(*) as total")
            ->where('waktu_daftar', '>=', $start)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Pets distribution by ras
        $petByRas = DB::table('pet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->select('ras_hewan.nama_ras', DB::raw('COUNT(*) as total'))
            ->groupBy('ras_hewan.idras_hewan', 'ras_hewan.nama_ras')
            ->orderBy('total', 'desc')
            ->get();

        // Prepare arrays for JS charts (ensure simple types)
        $monthlyLabels = $monthlyVisits->pluck('month')->map(function ($m) { return (string) $m; })->toArray();
        $monthlyTotals = $monthlyVisits->pluck('total')->map(function ($v) { return (int) $v; })->toArray();

        $petLabels = $petByRas->pluck('nama_ras')->map(function ($s) { return (string) $s; })->toArray();
        $petValues = $petByRas->pluck('total')->map(function ($v) { return (int) $v; })->toArray();

        // also prepare delimiter-joined strings to avoid relying on json_encode in Blade
        $monthlyLabelsCsv = implode('|', $monthlyLabels);
        $monthlyTotalsCsv = implode(',', $monthlyTotals);
        $petLabelsCsv = implode('|', array_map(function ($s) { return str_replace('|', '-', $s); }, $petLabels));
        $petValuesCsv = implode(',', $petValues);

        return view('admin.dashboard', compact(
            'data', 'role', 'stats', 'monthlyVisits', 'petByRas',
            'monthlyLabels', 'monthlyTotals', 'petLabels', 'petValues',
            'monthlyLabelsCsv', 'monthlyTotalsCsv', 'petLabelsCsv', 'petValuesCsv'
        ));
    }
}
