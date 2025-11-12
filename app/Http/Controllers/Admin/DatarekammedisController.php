<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $rekamMediss = RekamMedis::with('temuDokter.pet', 'roleUser.user')->get();
        return view('admin.datarekammedis.index', compact('rekamMediss'));
    }

    public function create()
    {
        $temuDokters = \App\Models\TemuDokter::with('pet')->get();
        $dokters = \App\Models\RoleUser::with('user')->whereHas('role', function($q) {
            $q->where('nama_role', 'Dokter');
        })->get();
        return view('admin.datarekammedis.create', compact('temuDokters', 'dokters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

    // Normalize text fields using helper for consistent formatting
    $validatedData['anamnesa'] = normalize_name($validatedData['anamnesa']);
    $validatedData['temuan_klinis'] = normalize_name($validatedData['temuan_klinis']);
    $validatedData['diagnosa'] = normalize_name($validatedData['diagnosa']);

    $validatedData['created_at'] = now();

    RekamMedis::create($validatedData);

        return redirect()->route('admin.datarekammedis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.datarekammedis.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datarekammedis.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datarekammedis.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();
        return redirect()->route('admin.datarekammedis.index')->with('success', 'Data deleted.');
    }
}
