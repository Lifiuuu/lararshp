<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = DB::table('dokter')
            ->leftJoin('user', 'dokter.id_user', '=', 'user.iduser')
            ->select('dokter.*', 'user.nama as user_name', 'user.email as user_email')
            ->get();
        return view('admin.datadokter.index', compact('dokters'));
    }

    public function create()
    {
        // Only include users that have an active role assignment to 'dokter'
        $users = DB::table('user')
            ->leftJoin('role_user', function ($join) {
                $join->on('user.iduser', '=', 'role_user.iduser')
                     ->where('role_user.status', '=', 1);
            })
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->whereRaw("LOWER(role.nama_role) = 'dokter'")
            ->select('user.*')
            ->get();

        return view('admin.datadokter.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'bidang_dokter' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('dokter')->insert([
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'bidang_dokter' => $request->input('bidang_dokter'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'id_user' => $request->input('id_user'),
        ]);

        return redirect()->route('admin.datadokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function show($id)
    {
        $dokter = DB::table('dokter')->where('id_dokter', $id)->first();
        if (!$dokter) abort(404);
        return view('admin.datadokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $dokter = DB::table('dokter')->where('id_dokter', $id)->first();
        if (!$dokter) abort(404);
        // Only include users that have an active role assignment to 'dokter'
        $users = DB::table('user')
            ->leftJoin('role_user', function ($join) {
                $join->on('user.iduser', '=', 'role_user.iduser')
                     ->where('role_user.status', '=', 1);
            })
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->whereRaw("LOWER(role.nama_role) = 'dokter'")
            ->select('user.*')
            ->get();
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

        $updated = DB::table('dokter')->where('id_dokter', $id)->update([
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'bidang_dokter' => $request->input('bidang_dokter'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'id_user' => $request->input('id_user'),
        ]);

        if ($updated === 0) {
            if (!DB::table('dokter')->where('id_dokter', $id)->exists()) {
                abort(404);
            }
        }

        return redirect()->route('admin.datadokter.index')->with('success', 'Dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $deleted = DB::table('dokter')->where('id_dokter', $id)->delete();
        if ($deleted === 0) {
            abort(404);
        }
        return redirect()->route('admin.datadokter.index')->with('success', 'Dokter berhasil dihapus.');
    }
}