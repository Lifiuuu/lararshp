<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Carbon\Carbon;

class DatarekammedisController extends Controller
{
    public function index()
    {
        // Use Eloquent: join to allow ordering by temu_dokter.waktu_daftar, eager load relations for the view
        $rekamMediss = RekamMedis::join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->where('temu_dokter.status', '!=', 'D')
            ->orderBy('temu_dokter.waktu_daftar', 'desc')
            ->select('rekam_medis.*')
            ->with('temuDokter.pet.pemilik.user', 'roleUser.user')
            ->get();

        return view('admin.datarekammedis.index', compact('rekamMediss'));
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

        return view('admin.datarekammedis.create', compact('temuDokters'));
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

        // $temu = DB::table('temu_dokter')->where('idreservasi_dokter', $validated['idreservasi_dokter'])->first();
        // if (!$temu) {
        //     return redirect()->back()->withErrors(['idreservasi_dokter' => 'Reservasi tidak ditemukan.']);
        // }

        $validated['dokter_pemeriksa'] = $temu->idrole_user;
        $validated['anamnesa'] = normalize_name($validated['anamnesa']);
        $validated['temuan_klinis'] = normalize_name($validated['temuan_klinis']);
        $validated['diagnosa'] = normalize_name($validated['diagnosa']);
        $validated['created_at'] = now();

        RekamMedis::create($validated);

        // DB::table('rekam_medis')->insert($validated);

        return redirect()->route('admin.datarekammedis.index')->with('success', 'Rekam medis dibuat.');
    }

    public function edit($id)
    {
        $rekam = RekamMedis::findOrFail($id);

        // $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        // if (!$rekam) abort(404);

        $temu = $rekam->temuDokter;

        // $temu = DB::table('temu_dokter')->where('idreservasi_dokter', $rekam->idreservasi_dokter)->first();

        // Get dokter name
        $dokter = $rekam->roleUser->user ?? null;

        // $dokter = DB::table('role_user')
        //     ->join('user', 'role_user.iduser', '=', 'user.iduser')
        //     ->where('role_user.idrole_user', $rekam->dokter_pemeriksa)
        //     ->select('user.nama as nama_dokter')
        //     ->first();

        return view('admin.datarekammedis.edit', compact('rekam', 'temu', 'dokter'));
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

        // $exists = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        // if (!$exists) abort(404);

        // DB::table('rekam_medis')->where('idrekam_medis', $id)->update($validated);

        return redirect()->route('admin.datarekammedis.index')->with('success', 'Rekam medis diperbarui.');
    }

    public function destroy($id)
    {
        RekamMedis::findOrFail($id)->delete();

        // $exists = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        // if (!$exists) abort(404);
        // DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();
        return redirect()->route('admin.datarekammedis.index')->with('success', 'Rekam medis dihapus.');
    }
}
