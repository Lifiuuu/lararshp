<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        return redirect()->route('admin.pemilik.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.pemilik.index')->with('info', 'Store not implemented yet.');
    }

    public function show($id)
    {
        return redirect()->route('admin.pemilik.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.pemilik.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.pemilik.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();
        return redirect()->route('admin.pemilik.index')->with('success', 'Data deleted.');
    }
}
