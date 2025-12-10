<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\DataUser;
use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->whereHas('user', fn($q) => $q->whereNull('deleted_at'))->get();
        // $dokters = DB::table('dokter')
        //     ->leftJoin('user', 'dokter.id_user', '=', 'user.iduser')
        //     ->select('dokter.*', 'user.nama as user_name', 'user.email as user_email')
        //     ->get();
        return view('admin.datadokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('admin.datadokter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'bidang_dokter' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::transaction(function () use ($request) {
            // Create user
            $user = DataUser::create([
                'nama' => normalize_name($request->nama),
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Get or create role
            $role = Role::firstOrCreate(['nama_role' => 'Dokter']);

            // Assign role to user
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $role->idrole,
                'status' => 1,
            ]);

            // Create dokter
            Dokter::create([
                'id_user' => $user->iduser,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'bidang_dokter' => $request->bidang_dokter,
                'jenis_kelamin' => $request->jenis_kelamin,
            ]);
        });

        return redirect()->route('admin.datadokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function show($id)
    {
        $dokter = Dokter::findOrFail($id);
        // $dokter = DB::table('dokter')->where('id_dokter', $id)->first();
        // if (!$dokter) abort(404);
        return view('admin.datadokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        // $dokter = DB::table('dokter')->where('id_dokter', $id)->first();
        // if (!$dokter) abort(404);
        // Only include users that have an active role assignment to 'dokter'
        $users = RoleUser::with('user')->whereHas('role', function($q) {
            $q->where('nama_role', 'Dokter');
        })->where('status', 1)->whereHas('user', fn($q) => $q->whereNull('deleted_at'))->get()->pluck('user');
        // $users = DB::table('user')
        //     ->leftJoin('role_user', function ($join) {
        //         $join->on('user.iduser', '=', 'role_user.iduser')
        //              ->where('role_user.status', '=', 1);
        //     })
        //     ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
        //     ->whereRaw("LOWER(role.nama_role) = 'dokter'")
        //     ->select('user.*')
        //     ->get();
        return view('admin.datadokter.edit', compact('dokter', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'bidang_dokter' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'id_user' => 'required|exists:user,iduser',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->update($request->all());
        // $updated = DB::table('dokter')->where('id_dokter', $id)->update([
        //     'alamat' => $request->input('alamat'),
        //     'no_hp' => $request->input('no_hp'),
        //     'bidang_dokter' => $request->input('bidang_dokter'),
        //     'jenis_kelamin' => $request->input('jenis_kelamin'),
        //     'id_user' => $request->input('id_user'),
        // ]);

        // if ($updated === 0) {
        //     if (!DB::table('dokter')->where('id_dokter', $id)->exists()) {
        //         abort(404);
        //     }
        // }

        return redirect()->route('admin.datadokter.index')->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Dokter::findOrFail($id)->delete();
        // $deleted = DB::table('dokter')->where('id_dokter', $id)->delete();
        // if ($deleted === 0) {
        //     abort(404);
        // }
        return redirect()->route('admin.datadokter.index')->with('success', 'Dokter berhasil dihapus.');
    }
}