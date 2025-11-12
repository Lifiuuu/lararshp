<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class DatapetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik', 'rasHewan')->get();
        return view('admin.datapet.index', compact('pets'));
    }

    public function create()
    {
        // eager load user to be able to show owner's name in dropdown
        $pemiliks = \App\Models\Pemilik::with('user')->get();
        $rasHewans = \App\Models\RasHewan::with('jenisHewan')->get();
        return view('admin.datapet.create', compact('pemiliks', 'rasHewans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:2',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:255',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        Pet::create($validatedData);

        return redirect()->route('admin.datapet.index')->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return redirect()->route('admin.datapet.index')->with('success', 'Data deleted.');
    }
}
