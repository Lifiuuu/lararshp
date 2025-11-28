<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailRekamMedisController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $roleUser = DB::table('role_user')->where('iduser', $userId)->where('idrole', 2)->first(); // 2 = Dokter
        if (!$roleUser) abort(403);

        $query = DB::table('detail_rekam_medis as d')
            ->join('rekam_medis as r', 'd.idrekam_medis', '=', 'r.idrekam_medis')
            ->join('kode_tindakan_terapi as k', 'd.idkode_tindakan_terapi', '=', 'k.idkode_tindakan_terapi')
            ->leftJoin('kategori as kat', 'k.idkategori', '=', 'kat.idkategori')
            ->leftJoin('kategori_klinis as kk', 'k.idkategori_klinis', '=', 'kk.idkategori_klinis')
            ->leftJoin('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->select('d.*', 'r.anamnesa', 'k.kode', 'k.deskripsi_tindakan_terapi', 'kat.nama_kategori', 'kk.nama_kategori_klinis', 'p.nama as nama_pet', 't.waktu_daftar')
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user);

        if (request('rekam_medis')) {
            $query->where('d.idrekam_medis', request('rekam_medis'));
        }

        $details = $query->orderBy('d.iddetail_rekam_medis', 'desc')->get();

        return view('dokter.detailrekammedis.index', compact('details'));
    }

    public function create($idrekam)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $idrekam)->first();
        if (!$rekam) abort(404);

        // Get tindakans that are not already used for this rekam_medis
        $usedTindakans = DB::table('detail_rekam_medis')->where('idrekam_medis', $idrekam)->pluck('idkode_tindakan_terapi')->toArray();
        $tindakans = DB::table('kode_tindakan_terapi')->whereNotIn('idkode_tindakan_terapi', $usedTindakans)->get();

        return view('dokter.detailrekammedis.create', compact('rekam', 'tindakans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|array|min:1',
            'idkode_tindakan_terapi.*' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|array|min:1',
            'detail.*' => 'required|string|max:1000',
        ]);

        // Ensure arrays have same length
        if (count($validated['idkode_tindakan_terapi']) !== count($validated['detail'])) {
            return back()->withErrors(['error' => 'Jumlah tindakan dan detail tidak cocok.'])->withInput();
        }

        // Check for duplicates in submitted data
        if (count($validated['idkode_tindakan_terapi']) !== count(array_unique($validated['idkode_tindakan_terapi']))) {
            return back()->withErrors(['error' => 'Tindakan tidak boleh duplikat dalam form yang sama.'])->withInput();
        }

        // Check if any tindakan already exists for this rekam_medis
        $existing = DB::table('detail_rekam_medis')
            ->where('idrekam_medis', $validated['idrekam_medis'])
            ->whereIn('idkode_tindakan_terapi', $validated['idkode_tindakan_terapi'])
            ->exists();
        if ($existing) {
            return back()->withErrors(['error' => 'Salah satu tindakan sudah digunakan untuk rekam medis ini.'])->withInput();
        }

        $data = [];
        foreach ($validated['idkode_tindakan_terapi'] as $index => $tindakanId) {
            $data[] = [
                'idrekam_medis' => $validated['idrekam_medis'],
                'idkode_tindakan_terapi' => $tindakanId,
                'detail' => normalize_name($validated['detail'][$index]),
            ];
        }

        DB::table('detail_rekam_medis')->insert($data);

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
