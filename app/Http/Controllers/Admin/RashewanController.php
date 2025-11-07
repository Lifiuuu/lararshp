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
        return redirect()->route('admin.rashewan.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.rashewan.index')->with('info', 'Store not implemented yet.');
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
