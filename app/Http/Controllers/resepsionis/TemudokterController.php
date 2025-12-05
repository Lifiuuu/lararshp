<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Role;

class TemudokterController extends Controller
{
    public function index()
    {
        $temudokters = TemuDokter::with('pet.pemilik.user', 'roleUser.user')->orderBy('waktu_daftar', 'desc')->get();

        // $temudokters = DB::table('temu_dokter as t')
        //     ->leftJoin('pet as p', 't.idpet', '=', 'p.idpet')
        //     ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
        //     ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
        //     ->select('t.*', 'p.nama as nama_pet', 'u.nama as nama_pemilik')
        //     ->orderBy('t.waktu_daftar', 'desc')
        //     ->get();

        // Pets with owner name for the inline create form
        $pets = Pet::with('pemilik.user')->get();

        // $pets = DB::table('pet as p')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
        //     ->select('p.*', 'u.nama as nama_pemilik')
        //     ->get();

        // Doctors (role_user entries with role = Dokter) with user name
        $doctors = RoleUser::with('user')->whereHas('role', fn($q) => $q->where('nama_role', 'Dokter'))->get();

        // $doctors = DB::table('role_user')
        //     ->join('role', 'role_user.idrole', '=', 'role.idrole')
        //     ->join('user', 'role_user.iduser', '=', 'user.iduser')
        //     ->where('role.nama_role', 'Dokter')
        //     ->select('role_user.*', 'user.nama as user_nama')
        //     ->get();

        return view('resepsionis.temudokter.index', compact('temudokters', 'pets', 'doctors'));
    }

    public function create()
    {
        // Pets and doctors for the create form
        $pets = Pet::with('pemilik.user')->get();
        $doctors = RoleUser::with('user')->whereHas('role', fn($q) => $q->where('nama_role', 'Dokter'))->get();

        return view('resepsionis.temudokter.create', compact('pets', 'doctors'));
    }

    public function store(Request $request)
    {
        // Validate pet and allow either an existing role_user (dokter)
        // or request to create a role_user for an existing user.
        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'nullable|exists:role_user,idrole_user',
            // optional: when creating a new dokter role_user on the fly
            'create_dokter' => 'nullable|boolean',
            'iduser_for_dokter' => 'nullable|exists:user,iduser',
        ]);

        // If the form requested to create a role_user (dokter) on the fly,
        // create a new role_user entry and use its id for the reservation.
        $idrole_user = $validated['idrole_user'] ?? null;
        if (empty($idrole_user) && !empty($validated['create_dokter']) && !empty($validated['iduser_for_dokter'])) {
            // Find role id for 'Dokter'
            $role = Role::where('nama_role', 'Dokter')->first();
            if ($role) {
                $idrole = $role->idrole;
                $iduser = $validated['iduser_for_dokter'];
                // Insert into role_user and get inserted id
                $roleUser = RoleUser::create([
                    'idrole' => $idrole,
                    'iduser' => $iduser,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
                $idrole_user = $roleUser->idrole_user;
            }
        }

        // // If the form requested to create a role_user (dokter) on the fly,
        // // create a new role_user entry and use its id for the reservation.
        // $idrole_user = $validated['idrole_user'] ?? null;
        // if (empty($idrole_user) && !empty($validated['create_dokter']) && !empty($validated['iduser_for_dokter'])) {
        //     // Find role id for 'Dokter'
        //     $role = DB::table('role')->where('nama_role', 'Dokter')->first();
        //     if ($role) {
        //         $idrole = $role->idrole;
        //         $iduser = $validated['iduser_for_dokter'];
        //         // Insert into role_user and get inserted id
        //         $idrole_user = DB::table('role_user')->insertGetId([
        //             'idrole' => $idrole,
        //             'iduser' => $iduser,
        //             'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //         ]);
        //     }
        // }

        if (empty($idrole_user)) {
            return redirect()->back()->withErrors(['idrole_user' => 'Dokter belum dipilih atau tidak dapat dibuat.'])->withInput();
        }

        // Compute defaults: status = 'P' (Pending)
        // and compute no_urut as (max for today) + 1 overall
        $today = Carbon::today()->toDateString();
        $maxNo = TemuDokter::whereDate('waktu_daftar', $today)->max('no_urut');
        $no_urut = ($maxNo ?? 0) + 1;

        // // Compute defaults: waktu_daftar = now, status = 'P' (Pending)
        // // and compute no_urut as (max for today) + 1 for that doctor
        // $waktu_daftar = Carbon::now()->format('Y-m-d H:i:s');
        // $today = Carbon::today()->toDateString();
        // $maxNo = DB::table('temu_dokter')
        //     ->whereDate('waktu_daftar', $today)
        //     ->where('idrole_user', $idrole_user)
        //     ->max('no_urut');
        // $no_urut = ($maxNo ?? 0) + 1;

        try {
            TemuDokter::create([
                'no_urut' => $no_urut,
                // 'waktu_daftar' => $waktu_daftar, // Removed, let DB default handle it
                'status' => 'P',
                'idpet' => $validated['idpet'],
                'idrole_user' => $idrole_user,
            ]);

            return redirect()->route('resepsionis.temudokter.index')->with('success', 'Temu dokter dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal membuat temu dokter: ' . $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $temu = TemuDokter::findOrFail($id);

        // $temu = DB::table('temu_dokter')->where('idreservasi_dokter', $id)->first();
        // if (!$temu) abort(404);

        return view('resepsionis.temudokter.edit', compact('temu'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:P,D,C',
        ]);

        $temu = TemuDokter::findOrFail($id);
        $temu->update($validated);

        // $exists = DB::table('temu_dokter')->where('idreservasi_dokter', $id)->first();
        // if (!$exists) abort(404);

        // DB::table('temu_dokter')->where('idreservasi_dokter', $id)->update($validated);

        return redirect()->route('resepsionis.temudokter.index')->with('success', 'Status temu dokter diperbarui.');
    }

    public function destroy($id)
    {
        TemuDokter::findOrFail($id)->delete();

        // $exists = DB::table('temu_dokter')->where('idreservasi_dokter', $id)->first();
        // if (!$exists) abort(404);
        // DB::table('temu_dokter')->where('idreservasi_dokter', $id)->delete();
        return redirect()->route('resepsionis.temudokter.index')->with('success', 'Temu dokter dihapus.');
    }
}
