<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use Illuminate\Support\Facades\DB;

class DatapemilikController extends Controller
{
    public function index()
    {
        // $pemiliks = Pemilik::with('user')->get();
        $pemiliks = DB::table('pemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.*', 'user.nama as nama_user', 'user.email')
            ->get();
        return view('admin.datapemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        return view('admin.datapemilik.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'alamat' => 'required|string|max:255|min:5',
            'telepon' => 'required|integer|digits_between:12,20',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        // Pemilik::create($validatedData);
        DB::table('pemilik')->insert($validatedData);

        return redirect()->route('admin.datapemilik.index')->with('success', 'Data created successfully.');
    }

    

    public function show($id)
    {
        return redirect()->route('admin.datapemilik.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datapemilik.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datapemilik.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        // $pemilik = Pemilik::findOrFail($id);
        // $pemilik->delete();
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        if (!$pemilik) {
            abort(404);
        }
        DB::table('pemilik')->where('idpemilik', $id)->delete();
        return redirect()->route('admin.datapemilik.index')->with('success', 'Data deleted.');
    }
}
