<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use Illuminate\Support\Facades\DB;

class DatatindakanController extends Controller
{
    public function index()
    {
        // $tindakans = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        $tindakans = DB::table('kode_tindakan_terapi')
            ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->join('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select('kode_tindakan_terapi.*', 'kategori.nama_kategori', 'kategori_klinis.nama_kategori_klinis')
            ->get();
        return view('admin.datatindakan.index', compact('tindakans'));
    }

    public function create()
    {
        // $kategoris = \App\Models\Kategori::all();
        $kategoris = DB::table('kategori')->get();
        
        // $kategoriKliniss = \App\Models\KategoriKlinis::all();
        $kategoriKliniss = DB::table('kategori_klinis')->get();
        return view('admin.datatindakan.create', compact('kategoris', 'kategoriKliniss'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|string|max:50|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        // Normalize description for consistent casing
        $validatedData['deskripsi_tindakan_terapi'] = normalize_name($validatedData['deskripsi_tindakan_terapi']);

        // KodeTindakanTerapi::create($validatedData);
        DB::table('kode_tindakan_terapi')->insert($validatedData);

        return redirect()->route('admin.datatindakan.index')->with('success', 'Data tindakan berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.datatindakan.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datatindakan.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datatindakan.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        // $tindakan = KodeTindakanTerapi::findOrFail($id);
        // $tindakan->delete();
        $tindakan = DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->first();
        if (!$tindakan) {
            abort(404);
        }
        DB::table('kode_tindakan_terapi')->where('idkode_tindakan_terapi', $id)->delete();
        return redirect()->route('admin.datatindakan.index')->with('success', 'Data deleted.');
    }
}
