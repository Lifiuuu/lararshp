<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemilik;
use App\Models\DataUser;
use App\Models\Role;
use App\Models\RoleUser;

class DatapemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->whereHas('user', function($query) {
            $query->whereNull('deleted_at');
        })->get();

        // $pemiliks = DB::table('pemilik as pm')
        //     ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
        //     ->select('pm.*', 'u.nama as user_nama', 'u.email as user_email')
        //     ->get();

        return view('resepsionis.datapemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        return view('resepsionis.datapemilik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_wa' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Buat user baru
        $user = DataUser::create([
            'nama' => normalize_name($validated['nama']),
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Assign role Pemilik
        $rolePemilik = Role::where('nama_role', 'Pemilik')->first();
        if ($rolePemilik) {
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $rolePemilik->idrole,
            ]);
        }

        // Buat pemilik
        Pemilik::create([
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
            'iduser' => $user->iduser,
        ]);

        return redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);

        // $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        // if (!$pemilik) abort(404);
        $users = DataUser::all();

        // $users = DB::table('user')->get();
        return view('resepsionis.datapemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_wa' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'iduser' => 'nullable|exists:user,iduser'
        ]);

        $pemilik = Pemilik::findOrFail($id);
        $pemilik->update($validated);

        // $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        // if (!$pemilik) abort(404);

        // DB::table('pemilik')->where('idpemilik', $id)->update([
        //     'no_wa' => $validated['no_wa'],
        //     'alamat' => $validated['alamat'],
        //     'iduser' => $validated['iduser'] ?? null,
        // ]);

        return redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik diperbarui.');
    }

    public function destroy($id)
    {
        Pemilik::findOrFail($id)->delete();

        // $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        // if (!$pemilik) abort(404);
        // DB::table('pemilik')->where('idpemilik', $id)->delete();
        return redirect()->route('resepsionis.datapemilik.index')->with('success', 'Pemilik dihapus.');
    }
}
