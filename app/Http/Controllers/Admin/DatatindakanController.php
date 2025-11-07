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
        return redirect()->route('admin.datatindakan.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.datatindakan.index')->with('info', 'Store not implemented yet.');
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
