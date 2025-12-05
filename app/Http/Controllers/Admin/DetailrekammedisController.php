<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\DetailRekamMedis;
use App\Models\RekamMedis;
use App\Models\KodeTindakanTerapi;

class DetailrekammedisController extends Controller
{
    public function index()
    {
        $details = DetailRekamMedis::with('rekamMedis.temuDokter.pet', 'kodeTindakanTerapi.kategori', 'kodeTindakanTerapi.kategoriKlinis')
            ->when(request('rekam_medis'), function($q) {
                $q->where('idrekam_medis', request('rekam_medis'));
            })
            ->orderBy('iddetail_rekam_medis', 'desc')
            ->get();

        return view('admin.detailrekammedis.index', compact('details'));
    }

    public function create($idrekam)
    {
        $rekam = RekamMedis::findOrFail($idrekam);

        // Get tindakans that are not already used for this rekam_medis
        $usedTindakans = DetailRekamMedis::where('idrekam_medis', $idrekam)->pluck('idkode_tindakan_terapi')->toArray();
        $tindakans = KodeTindakanTerapi::whereNotIn('idkode_tindakan_terapi', $usedTindakans)->get();

        return view('admin.detailrekammedis.create', compact('rekam', 'tindakans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|array|min:1',
            'idkode_tindakan_terapi.*' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'array',
            'detail.*' => 'nullable|string|max:1000',
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
        $existing = DetailRekamMedis::where('idrekam_medis', $validated['idrekam_medis'])
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
                'detail' => normalize_name($validated['detail'][$index] ?? ''),
            ];
        }

        DetailRekamMedis::insert($data);

        return redirect()->route('admin.datatindakan.index')->with('success', 'Detail rekam medis ditambahkan.');
    }

    public function edit($id)
    {
        $detail = DetailRekamMedis::with('kodeTindakanTerapi')->findOrFail($id);

        $tindakans = KodeTindakanTerapi::all();

        return view('admin.detailrekammedis.edit', compact('detail', 'tindakans'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string|max:1000',
        ]);

        $validated['detail'] = normalize_name($validated['detail'] ?? '');

        $detail = DetailRekamMedis::findOrFail($id);
        $detail->update($validated);

        return redirect()->route('admin.datatindakan.index')->with('success', 'Detail rekam medis diperbarui.');
    }

    public function destroy($id)
    {
        DetailRekamMedis::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Detail rekam medis dihapus.');
    }
}
