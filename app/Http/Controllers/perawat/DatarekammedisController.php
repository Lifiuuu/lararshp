<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatarekammedisController extends Controller
{
    public function index()
    {
        // Join rekam_medis with temu_dokter, pet, pemilik(user) and dokter (role_user->user)
        $rekamMediss = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u_owner', 'pm.iduser', '=', 'u_owner.iduser')
            ->leftJoin('role_user as ru_doc', 'r.dokter_pemeriksa', '=', 'ru_doc.idrole_user')
            ->leftJoin('user as u_doc', 'ru_doc.iduser', '=', 'u_doc.iduser')
            ->select(
                'r.*',
                't.no_urut',
                't.waktu_daftar',
                'p.nama as nama_pet',
                'u_owner.nama as nama_pemilik',
                'pm.no_wa as pemilik_no_wa',
                'u_doc.nama as nama_dokter'
            )
            ->where('t.status', '!=', 'D')
            ->orderBy('t.waktu_daftar', 'desc')
            ->get();

        return view('perawat.datarekammedis.index', compact('rekamMediss'));
    }

    public function create()
    {
        // Get temu_dokter with status 'P' and not already in rekam_medis
        $temuDokters = DB::table('temu_dokter as t')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->where('t.status', 'P')
            ->whereNotIn('t.idreservasi_dokter', function($query) {
                $query->select('idreservasi_dokter')->from('rekam_medis');
            })
            ->select('t.*', 'p.nama as nama_pet', 'u.nama as nama_pemilik')
            ->get();

        return view('perawat.datarekammedis.create', compact('temuDokters'));
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
        $temu = DB::table('temu_dokter')->where('idreservasi_dokter', $validated['idreservasi_dokter'])->first();
        if (!$temu) {
            return redirect()->back()->withErrors(['idreservasi_dokter' => 'Reservasi tidak ditemukan.']);
        }

        $validated['dokter_pemeriksa'] = $temu->idrole_user;
        $validated['anamnesa'] = normalize_name($validated['anamnesa']);
        $validated['temuan_klinis'] = normalize_name($validated['temuan_klinis']);
        $validated['diagnosa'] = normalize_name($validated['diagnosa']);
        $validated['created_at'] = now();

        DB::table('rekam_medis')->insert($validated);

        return redirect()->route('perawat.datarekammedis.index')->with('success', 'Rekam medis dibuat.');
    }

    public function edit($id)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$rekam) abort(404);

        $temu = DB::table('temu_dokter')->where('idreservasi_dokter', $rekam->idreservasi_dokter)->first();

        // Get dokter name
        $dokter = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role_user.idrole_user', $rekam->dokter_pemeriksa)
            ->select('user.nama as nama_dokter')
            ->first();

        return view('perawat.datarekammedis.edit', compact('rekam', 'temu', 'dokter'));
    }

    /**
     * Show delete confirmation page for a rekam medis
     */
    public function delete($id)
    {
        $rekam = DB::table('rekam_medis as r')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u_owner', 'pm.iduser', '=', 'u_owner.iduser')
            ->select('r.*', 'p.nama as nama_pet', 'u_owner.nama as nama_pemilik', 't.waktu_daftar')
            ->where('r.idrekam_medis', $id)
            ->first();

        if (!$rekam) abort(404);

        return view('perawat.datarekammedis.delete', compact('rekam'));
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

        $exists = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$exists) abort(404);

        DB::table('rekam_medis')->where('idrekam_medis', $id)->update($validated);

        return redirect()->route('perawat.datarekammedis.index')->with('success', 'Rekam medis diperbarui.');
    }

    public function destroy($id)
    {
        $exists = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$exists) abort(404);
        DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();
        return redirect()->route('perawat.datarekammedis.index')->with('success', 'Rekam medis dihapus.');
    }
}
