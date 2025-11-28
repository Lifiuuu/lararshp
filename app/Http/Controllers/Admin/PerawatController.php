<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = DB::table('perawat')
            ->leftJoin('user', 'perawat.id_user', '=', 'user.iduser')
            ->select('perawat.*', 'user.nama as user_name', 'user.email as user_email')
            ->get();
        return view('admin.dataperawat.index', compact('perawats'));
    }

    public function create()
    {
        // Only include users that have an active role assignment to 'perawat'
        $users = DB::table('user')
            ->leftJoin('role_user', function ($join) {
                $join->on('user.iduser', '=', 'role_user.iduser')
                     ->where('role_user.status', '=', 1);
            })
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->whereRaw("LOWER(role.nama_role) = 'perawat'")
            ->select('user.*')
            ->get();

        return view('admin.dataperawat.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100',
            'id_user' => 'required|exists:user,iduser',
        ]);

        DB::table('perawat')->insert([
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'pendidikan' => $request->input('pendidikan'),
            'id_user' => $request->input('id_user'),
        ]);

        return redirect()->route('admin.dataperawat.index')->with('success', 'Perawat berhasil ditambahkan.');
    }

    public function show($id)
    {
        $perawat = DB::table('perawat')->where('id_perawat', $id)->first();
        if (!$perawat) abort(404);
        return view('admin.dataperawat.show', compact('perawat'));
    }

    public function edit($id)
    {
        $perawat = DB::table('perawat')->where('id_perawat', $id)->first();
        if (!$perawat) abort(404);
        // Only include users that have an active role assignment to 'perawat'
        $users = DB::table('user')
            ->leftJoin('role_user', function ($join) {
                $join->on('user.iduser', '=', 'role_user.iduser')
                     ->where('role_user.status', '=', 1);
            })
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->whereRaw("LOWER(role.nama_role) = 'perawat'")
            ->select('user.*')
            ->get();
        return view('admin.dataperawat.edit', compact('perawat', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100',
            'id_user' => 'required|exists:user,iduser',
        ]);

        $updated = DB::table('perawat')->where('id_perawat', $id)->update([
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'pendidikan' => $request->input('pendidikan'),
            'id_user' => $request->input('id_user'),
        ]);

        if ($updated === 0) {
            if (!DB::table('perawat')->where('id_perawat', $id)->exists()) {
                abort(404);
            }
        }

        return redirect()->route('admin.dataperawat.index')->with('success', 'Perawat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $deleted = DB::table('perawat')->where('id_perawat', $id)->delete();
        if ($deleted === 0) {
            abort(404);
        }
        return redirect()->route('admin.dataperawat.index')->with('success', 'Perawat berhasil dihapus.');
    }
}