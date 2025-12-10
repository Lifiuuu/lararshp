<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\DataUser;
use App\Models\Perawat;
use Illuminate\Http\Request;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::with('user')->whereHas('user', fn($q) => $q->whereNull('deleted_at'))->get();

        // $perawats = DB::table('perawat')
        //     ->leftJoin('user', 'perawat.id_user', '=', 'user.iduser')
        //     ->select('perawat.*', 'user.nama as user_name', 'user.email as user_email')
        //     ->get();
        return view('admin.dataperawat.index', compact('perawats'));
    }

    public function create()
    {
        return view('admin.dataperawat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100',
        ]);

        DB::transaction(function () use ($request) {
            // Create user
            $user = DataUser::create([
                'nama' => normalize_name($request->nama),
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Get or create role
            $role = Role::firstOrCreate(['nama_role' => 'Perawat']);

            // Assign role to user
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $role->idrole,
                'status' => 1,
            ]);

            // Create perawat
            Perawat::create([
                'id_user' => $user->iduser,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan' => $request->pendidikan,
            ]);
        });

        return redirect()->route('admin.dataperawat.index')->with('success', 'Perawat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perawat = Perawat::findOrFail($id);

        // $perawat = DB::table('perawat')->where('id_perawat', $id)->first();
        // if (!$perawat) abort(404);
        return view('admin.dataperawat.show', compact('perawat'));
    }

    public function edit($id)
    {
        $perawat = Perawat::findOrFail($id);

        // $perawat = DB::table('perawat')->where('id_perawat', $id)->first();
        // if (!$perawat) abort(404);
        // Only include users that have an active role assignment to 'perawat'
        $users = \App\Models\RoleUser::with('user')->whereHas('role', function($q) {
            $q->where('nama_role', 'Perawat');
        })->where('status', 1)->whereHas('user', fn($q) => $q->whereNull('deleted_at'))->get()->pluck('user');
        return view('admin.dataperawat.edit', compact('perawat', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100',
            'id_user' => 'required|exists:user,iduser',
        ]);

        $perawat = Perawat::findOrFail($id);
        $perawat->update($validatedData);

        // $updated = DB::table('perawat')->where('id_perawat', $id)->update([
        //     'alamat' => $request->input('alamat'),
        //     'no_hp' => $request->input('no_hp'),
        //     'jenis_kelamin' => $request->input('jenis_kelamin'),
        //     'pendidikan' => $request->input('pendidikan'),
        //     'id_user' => $request->input('id_user'),
        // ]);

        // if ($updated === 0) {
        //     if (!DB::table('perawat')->where('id_perawat', $id)->exists()) {
        //         abort(404);
        //     }
        // }

        return redirect()->route('admin.dataperawat.index')->with('success', 'Perawat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Perawat::findOrFail($id)->delete();

        // $deleted = DB::table('perawat')->where('id_perawat', $id)->delete();
        // if ($deleted === 0) {
        //     abort(404);
        // }
        return redirect()->route('admin.dataperawat.index')->with('success', 'Perawat berhasil dihapus.');
    }
}