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
        return redirect()->route('admin.datapet.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Store not implemented yet.');
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
