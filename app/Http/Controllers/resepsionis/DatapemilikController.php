<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatapemilikController extends Controller
{
    public function index()
    {
        $pemiliks = DB::table('pemilik as pm')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select('pm.*', 'u.nama as user_nama', 'u.email as user_email')
            ->get();

        return view('resepsionis.datapemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        $users = DB::table('user')->get();
        return view('resepsionis.datapemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_wa' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'iduser' => 'nullable|exists:user,iduser'
        ]);

        DB::table('pemilik')->insert([
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
            'iduser' => $validated['iduser'] ?? null,
            'is_deleted' => 0,
        ]);

        return redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        if (!$pemilik) abort(404);
        $users = DB::table('user')->get();
        return view('resepsionis.datapemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_wa' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'iduser' => 'nullable|exists:user,iduser'
        ]);

        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        if (!$pemilik) abort(404);

        DB::table('pemilik')->where('idpemilik', $id)->update([
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
            'iduser' => $validated['iduser'] ?? null,
        ]);

        return redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik diperbarui.');
    }

    public function destroy($id)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        if (!$pemilik) abort(404);
        DB::table('pemilik')->where('idpemilik', $id)->delete();
        return redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik dihapus.');
    }
}
