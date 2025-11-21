<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailRekamMedisController extends Controller
{
    public function create($idrekam)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $idrekam)->first();
        if (!$rekam) abort(404);

        $tindakans = DB::table('kode_tindakan_terapi')->get();
        return view('dokter.detailrekammedis.create', compact('rekam', 'tindakans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string|max:1000',
        ]);

        $validated['detail'] = normalize_name($validated['detail']);

        DB::table('detail_rekam_medis')->insert($validated);

        return redirect()->route('dokter.datarekammedis.index')->with('success', 'Detail rekam medis ditambahkan.');
    }

    public function edit($id)
    {
        $detail = DB::table('detail_rekam_medis as d')
            ->leftJoin('kode_tindakan_terapi as k', 'd.idkode_tindakan_terapi', '=', 'k.idkode_tindakan_terapi')
            ->select('d.*', 'k.kode', 'k.deskripsi_tindakan_terapi')
            ->where('d.iddetail_rekam_medis', $id)
            ->first();
        if (!$detail) abort(404);

        $tindakans = DB::table('kode_tindakan_terapi')->get();
        return view('dokter.detailrekammedis.edit', compact('detail', 'tindakans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string|max:1000',
        ]);

        $validated['detail'] = normalize_name($validated['detail']);

        $exists = DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->first();
        if (!$exists) abort(404);

        DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->update($validated);

        return redirect()->route('dokter.datarekammedis.index')->with('success', 'Detail rekam medis diperbarui.');
    }

    public function destroy($id)
    {
        $exists = DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->first();
        if (!$exists) abort(404);
        DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->delete();
        return redirect()->back()->with('success', 'Detail rekam medis dihapus.');
    }
}
