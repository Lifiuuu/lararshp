<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;
use Illuminate\Support\Facades\DB;

class RashewanController extends Controller
{
    public function index()
    {
        $rasHewans = RasHewan::with('jenisHewan')->whereHas('jenisHewan', fn($q) => $q->whereNull('deleted_at'))->get();
        // $rasHewans = DB::table('ras_hewan')
        //     ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
        //     ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
        //     ->get();
        return view('admin.rashewan.index', compact('rasHewans'));
    }

    public function create()
    {
        $jenisHewans = \App\Models\JenisHewan::whereNull('deleted_at')->get();
        // $jenisHewans = DB::table('jenis_hewan')->get();
        return view('admin.rashewan.create', compact('jenisHewans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_ras' => 'required|string|max:255|min:3|unique:ras_hewan,nama_ras',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        $validatedData['nama_ras'] = normalize_name($validatedData['nama_ras']);

        RasHewan::create($validatedData);

        // DB::table('ras_hewan')->insert($validatedData);

        return redirect()->route('admin.rashewan.index')->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.rashewan.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        $ras = RasHewan::findOrFail($id);
        $jenisHewans = \App\Models\JenisHewan::whereNull('deleted_at')->get();
        return view('admin.rashewan.edit', compact('ras', 'jenisHewans'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_ras' => 'required|string|max:255|min:3|unique:ras_hewan,nama_ras,' . $id . ',idras_hewan',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        $validatedData['nama_ras'] = normalize_name($validatedData['nama_ras']);

        $ras = RasHewan::findOrFail($id);
        $ras->nama_ras = $validatedData['nama_ras'];
        $ras->idjenis_hewan = $validatedData['idjenis_hewan'];
        $ras->save();

        return redirect()->route('admin.rashewan.index')->with('success', 'Ras hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ras = RasHewan::findOrFail($id);
        $ras->delete();

        // $ras = DB::table('ras_hewan')->where('idras_hewan', $id)->first();
        // if (!$ras) {
        //     abort(404);
        // }
        // DB::table('ras_hewan')->where('idras_hewan', $id)->delete();
        return redirect()->route('admin.rashewan.index')->with('success', 'Data deleted.');
    }
}
