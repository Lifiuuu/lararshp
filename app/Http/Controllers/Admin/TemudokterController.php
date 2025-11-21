<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemudokterController extends Controller
{
    public function index()
    {
        $temudokters = DB::table('temu_dokter as t')
            ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select('t.*', 'p.nama as pet_nama', 'u.nama as pemilik_nama')
            ->get();

        return view('admin.temudokter.index', compact('temudokters'));
    }

    public function create()
    {
        $pets = DB::table('pet')->get();
        $pemilikRoleUsers = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role.nama_role', 'Pemilik')
            ->select('role_user.*', 'user.nama as user_nama')
            ->get();

        return view('admin.temudokter.create', compact('pets', 'pemilikRoleUsers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_urut' => 'required|integer|min:1',
            'waktu_daftar' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        DB::table('temu_dokter')->insert($validated);

        return redirect()->route('admin.temudokter.index')->with('success', 'Temu dokter dibuat.');
    }

    public function edit($id)
    {
        $temu = DB::table('temu_dokter')->where('idreservasi_dokter', $id)->first();
        if (!$temu) abort(404);

        $pets = DB::table('pet')->get();
        $pemilikRoleUsers = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->where('role.nama_role', 'Pemilik')
            ->select('role_user.*', 'user.nama as user_nama')
            ->get();

        return view('admin.temudokter.edit', compact('temu', 'pets', 'pemilikRoleUsers'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_urut' => 'required|integer|min:1',
            'waktu_daftar' => 'required|date_format:Y-m-d H:i:s',
            'status' => 'required|string',
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        $exists = DB::table('temu_dokter')->where('idreservasi_dokter', $id)->first();
        if (!$exists) abort(404);

        DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update($validated);

        return redirect()->route('admin.temudokter.index')->with('success', 'Temu dokter diperbarui.');
    }

    public function destroy($id)
    {
        $exists = DB::table('temu_dokter')->where('idreservasi_dokter', $id)->first();
        if (!$exists) abort(404);
        DB::table('temu_dokter')->where('idreservasi_dokter', $id)->delete();
        return redirect()->route('admin.temudokter.index')->with('success', 'Temu dokter dihapus.');
    }
}
