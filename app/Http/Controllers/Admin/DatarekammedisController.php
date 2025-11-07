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
        return redirect()->route('admin.datarekammedis.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.datarekammedis.index')->with('info', 'Store not implemented yet.');
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
