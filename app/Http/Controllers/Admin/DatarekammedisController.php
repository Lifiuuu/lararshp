<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\DB;

class DatarekammedisController extends Controller
{
    public function index()
    {
        // $rekamMediss = RekamMedis::with('temuDokter.pet', 'roleUser.user')->get();
        $rekamMediss = DB::table('rekam_medis')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->join('role_user', 'rekam_medis.dokter_pemeriksa', '=', 'role_user.idrole_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
                ->select('rekam_medis.*', 'pet.nama as nama_pet', 'user.nama as nama_dokter', 'temu_dokter.waktu_daftar as waktu_daftar')
            ->orderBy('rekam_medis.created_at', 'desc')
            ->get();
        return view('admin.datarekammedis.index', compact('rekamMediss'));
    }

    public function create()
    {
        // $temuDokters = \App\Models\TemuDokter::with('pet')->get();
        $temuDokters = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('temu_dokter.status', 'P') // only show pending reservations
            ->select('temu_dokter.*', 'pet.nama as nama_pet')
            ->orderBy('temu_dokter.waktu_daftar', 'asc')
            ->get();
        
        // $dokters = \App\Models\RoleUser::with('user')->whereHas('role', function($q) {
        //     $q->where('nama_role', 'Dokter');
        // })->get();
        $dokters = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role.nama_role', 'Dokter')
            ->select('role_user.*', 'user.nama as nama_user')
            ->get();
        return view('admin.datarekammedis.create', compact('temuDokters', 'dokters'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

    // Normalize text fields using helper for consistent formatting
    $validatedData['anamnesa'] = normalize_name($validatedData['anamnesa']);
    $validatedData['temuan_klinis'] = normalize_name($validatedData['temuan_klinis']);
    $validatedData['diagnosa'] = normalize_name($validatedData['diagnosa']);

    $validatedData['created_at'] = now();

    // RekamMedis::create($validatedData);
    DB::table('rekam_medis')->insert($validatedData);

        return redirect()->route('admin.datarekammedis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.datarekammedis.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$rekam) {
            abort(404);
        }

        // include pending reservations and the current one (even if not pending)
        $temuDokters = DB::table('temu_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where(function($q) use ($rekam) {
                $q->where('temu_dokter.status', 'P');
                $q->orWhere('temu_dokter.idreservasi_dokter', $rekam->idreservasi_dokter);
            })
            ->select('temu_dokter.*', 'pet.nama as nama_pet')
            ->orderBy('temu_dokter.waktu_daftar', 'asc')
            ->get();

        $dokters = DB::table('role_user')
            ->join('user', 'role_user.iduser', '=', 'user.iduser')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role.nama_role', 'Dokter')
            ->select('role_user.*', 'user.nama as nama_user')
            ->get();

        return view('admin.datarekammedis.edit', compact('rekam', 'temuDokters', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$rekam) {
            abort(404);
        }

        $validatedData = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $validatedData['anamnesa'] = normalize_name($validatedData['anamnesa']);
        $validatedData['temuan_klinis'] = normalize_name($validatedData['temuan_klinis']);
        $validatedData['diagnosa'] = normalize_name($validatedData['diagnosa']);

        $validatedData['updated_at'] = now();

        DB::table('rekam_medis')->where('idrekam_medis', $id)->update($validatedData);

        return redirect()->route('admin.datarekammedis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // $rekam = RekamMedis::findOrFail($id);
        // $rekam->delete();
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$rekam) {
            abort(404);
        }
        DB::table('rekam_medis')->where('idrekam_medis', $id)->delete();
        return redirect()->route('admin.datarekammedis.index')->with('success', 'Data deleted.');
    }
}
