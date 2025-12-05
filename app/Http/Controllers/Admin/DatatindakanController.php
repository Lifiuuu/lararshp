<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Carbon\Carbon;

class DatatindakanController extends Controller
{
    public function index()
    {
        // Use Eloquent: join to allow ordering by temu_dokter.waktu_daftar, eager load relations for the view
        $rekamMediss = RekamMedis::join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('temu_dokter.status', '!=', 'B')
            ->orderBy('temu_dokter.waktu_daftar', 'desc')
            ->select('rekam_medis.*')
            ->with('temuDokter.pet.pemilik.user', 'roleUser.user', 'detailRekamMedis.kodeTindakanTerapi.kategori', 'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis')
            ->get();

        return view('admin.datatindakan.index', compact('rekamMediss'));
    }

    public function create()
    {
        // Get temu_dokter with status 'P' and not already in rekam_medis
        $temuDokters = TemuDokter::with('pet.pemilik.user')
            ->where('status', 'P')
            ->whereDate('waktu_daftar', Carbon::today()->toDateString())
            ->whereNotIn('idreservasi_dokter', RekamMedis::pluck('idreservasi_dokter'))
            ->get()
            ->map(function($temu) {
                $temu->nama_pet = $temu->pet->nama ?? '';
                $temu->nama_pemilik = $temu->pet->pemilik->user->nama ?? '';
                return $temu;
            });

        return view('admin.datatindakan.create', compact('temuDokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        // Get dokter_pemeriksa from temu_dokter
        $temu = TemuDokter::findOrFail($validated['idreservasi_dokter']);

        $validated['dokter_pemeriksa'] = $temu->idrole_user;
        $validated['anamnesa'] = normalize_name($validated['anamnesa']);
        $validated['temuan_klinis'] = normalize_name($validated['temuan_klinis']);
        $validated['diagnosa'] = normalize_name($validated['diagnosa']);
        $validated['created_at'] = now();

        RekamMedis::create($validated);

        return redirect()->route('admin.datatindakan.index')->with('success', 'Rekam medis dibuat.');
    }

    public function edit($id)
    {
        $rekam = RekamMedis::findOrFail($id);

        $temu = $rekam->temuDokter;

        // Get dokter name
        $dokter = $rekam->roleUser->user ?? null;

        return view('admin.datatindakan.edit', compact('rekam', 'temu', 'dokter'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $validated['anamnesa'] = normalize_name($validated['anamnesa']);
        $validated['temuan_klinis'] = normalize_name($validated['temuan_klinis']);
        $validated['diagnosa'] = normalize_name($validated['diagnosa']);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->update($validated);

        return redirect()->route('admin.datatindakan.index')->with('success', 'Rekam medis diperbarui.');
    }

    public function destroy($id)
    {
        RekamMedis::findOrFail($id)->delete();

        return redirect()->route('admin.datatindakan.index')->with('success', 'Rekam medis dihapus.');
    }
}
