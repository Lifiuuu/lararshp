<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;

class RashewanController extends Controller
{
    public function index()
    {
        $rasHewans = RasHewan::with('jenisHewan')->get();
        return view('admin.rashewan.index', compact('rasHewans'));
    }

    public function create()
    {
        $jenisHewans = \App\Models\JenisHewan::all();
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

        return redirect()->route('admin.rashewan.index')->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.rashewan.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.rashewan.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.rashewan.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $ras = RasHewan::findOrFail($id);
        $ras->delete();
        return redirect()->route('admin.rashewan.index')->with('success', 'Data deleted.');
    }
}
