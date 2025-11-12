<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;

class DatatindakanController extends Controller
{
    public function index()
    {
        $tindakans = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        return view('admin.datatindakan.index', compact('tindakans'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        $kategoriKliniss = \App\Models\KategoriKlinis::all();
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

        KodeTindakanTerapi::create($validatedData);

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
        $tindakan = KodeTindakanTerapi::findOrFail($id);
        $tindakan->delete();
        return redirect()->route('admin.datatindakan.index')->with('success', 'Data deleted.');
    }
}
