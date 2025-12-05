<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;

class DatapemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->whereHas('user', function($query) {
            $query->whereNull('deleted_at');
        })->get();
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
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:255|min:5',
            'telepon' => 'required|numeric|digits_between:12,20',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        // Create user first
        $user = \App\Models\User::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Assign role 'pemilik'
        $rolePemilik = \App\Models\Role::where('nama_role', 'pemilik')->first();
        if ($rolePemilik) {
            \App\Models\RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $rolePemilik->idrole,
                'status' => 1,
            ]);
        }

        // Create pemilik
        Pemilik::create([
            'no_wa' => $validatedData['telepon'],
            'alamat' => $validatedData['alamat'],
            'iduser' => $user->iduser,
        ]);

        return redirect()->route('admin.datapemilik.index')->with('success', 'Data created successfully.');
    }

    

    public function show($id)
    {
        return redirect()->route('admin.datapemilik.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('admin.datapemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'alamat' => 'required|string|max:255|min:5',
            'telepon' => 'required|numeric|digits_between:12,20',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        $pemilik = Pemilik::with('user')->findOrFail($id);
        $pemilik->no_wa = $validatedData['telepon'];
        $pemilik->alamat = $validatedData['alamat'];
        $pemilik->save();

        // If pemilik has related user, update user name
        if ($pemilik->user) {
            $pemilik->user->nama = $validatedData['nama'];
            $pemilik->user->save();
        }

        return redirect()->route('admin.datapemilik.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();
        // $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        // if (!$pemilik) {
        //     abort(404);
        // }
        // DB::table('pemilik')->where('idpemilik', $id)->delete();
        return redirect()->route('admin.datapemilik.index')->with('success', 'Data deleted.');
    }
}
