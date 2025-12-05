<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUser;
use App\Models\Dokter;
use App\Models\Pemilik;
use App\Models\Perawat;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatauserController extends Controller
{
    public function index()
    {
        $users = DataUser::with('roles', 'pemilik')->whereNull('deleted_at')->get();
        // Use query builder to fetch user rows joined with role rows (may create multiple rows per user
        // when users have multiple roles). We normalize the result into one object per user and
        // attach a `roles` collection so views that expect `$user->roles` continue to work.
        // Only join active role_user rows (status = 1) so inactive role assignments
        // don't appear in the user's role list after updates.
        // $rawRows = DB::table('user')
        //     ->leftJoin('role_user', function ($join) {
        //         $join->on('user.iduser', '=', 'role_user.iduser')
        //              ->where('role_user.status', '=', 1);
        //     })
        //     ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
        //     ->leftJoin('pemilik', 'user.iduser', '=', 'pemilik.iduser')
        //     ->select('user.*', 'role.nama_role', 'user.nama as nama_pemilik', 'pemilik.no_wa as pemilik_no_wa')
        //     ->get();

        // // Group rows by user id and fold rows into a single user object with a `roles` collection
        // $users = $rawRows->groupBy('iduser')->map(function ($rows) {
        //     $first = $rows->first();
        //     $roles = $rows->pluck('nama_role')->filter()->unique()->map(function ($name) {
        //         return (object)['nama_role' => $name];
        //     })->values();
        //     // attach roles collection to the user object
        //     $first->roles = $roles;
        //     return $first;
        // })->values();
        return view('admin.datauser.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        // $roles = DB::table('role')->get();
        return view('admin.datauser.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:role,idrole',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = DataUser::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);
        // $userId = DB::table('user')->insertGetId([
        //     'nama' => $validatedData['nama'],
        //     'email' => $validatedData['email'],
        //     'password' => $validatedData['password'],
        // ]);

        foreach ($validatedData['roles'] as $roleId) {
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $roleId,
                'status' => 1,
            ]);
            // DB::table('role_user')->insert([
            //     'iduser' => $userId,
            //     'idrole' => $roleId,
            //     'status' => 1,
            // ]);
        }

        // Map selected role ids to role names so we can react to role choices
        $roleNames = Role::whereIn('idrole', $validatedData['roles'])->pluck('nama_role', 'idrole');
        // $roleNames = DB::table('role')->whereIn('idrole', $validatedData['roles'])->pluck('nama_role', 'idrole');

        // If Pemilik role selected, store pemilik extra data into `pemilik` table if table exists
        $pemilikRoleIds = $roleNames->filter(function($name){ return strtolower($name) === 'pemilik'; })->keys();
        if ($pemilikRoleIds->isNotEmpty()) {
            // validate pemilik fields
            $pemilikValidated = $request->validate([
                'pemilik_no_wa' => 'nullable|string|max:45',
                'pemilik_alamat' => 'nullable|string|max:100',
            ]);

            if (Schema::hasTable('pemilik')) {
                Pemilik::create([
                    'no_wa' => $pemilikValidated['pemilik_no_wa'] ?? null,
                    'alamat' => $pemilikValidated['pemilik_alamat'] ?? null,
                    'iduser' => $user->iduser,
                ]);
                // DB::table('pemilik')->insert([
                //     'no_wa' => $pemilikValidated['pemilik_no_wa'] ?? null,
                //     'alamat' => $pemilikValidated['pemilik_alamat'] ?? null,
                //     'iduser' => $userId,
                // ]);
            }
        }

        // If Dokter role selected, store dokter extra data into `dokter` table if table exists
        $dokterRoleIds = $roleNames->filter(function($name){ return strtolower($name) === 'dokter'; })->keys();
        if ($dokterRoleIds->isNotEmpty()) {
            // validate dokter fields
            $dokterValidated = $request->validate([
                'dokter_alamat' => 'nullable|string|max:100',
                'dokter_no_hp' => 'nullable|string|max:45',
                'dokter_bidang_dokter' => 'nullable|string|max:100',
                'dokter_jenis_kelamin' => 'nullable|in:L,P',
            ]);

            if (Schema::hasTable('dokter')) {
                Dokter::create([
                    'alamat' => $dokterValidated['dokter_alamat'] ?? null,
                    'no_hp' => $dokterValidated['dokter_no_hp'] ?? null,
                    'bidang_dokter' => $dokterValidated['dokter_bidang_dokter'] ?? null,
                    'jenis_kelamin' => $dokterValidated['dokter_jenis_kelamin'] ?? null,
                    'id_user' => $user->iduser,
                ]);
                // DB::table('dokter')->insert([
                //     'alamat' => $dokterValidated['dokter_alamat'] ?? null,
                //     'no_hp' => $dokterValidated['dokter_no_hp'] ?? null,
                //     'bidang_dokter' => $dokterValidated['dokter_bidang_dokter'] ?? null,
                //     'jenis_kelamin' => $dokterValidated['dokter_jenis_kelamin'] ?? null,
                //     'id_user' => $userId,
                // ]);
            }
        }

        // If Perawat role selected, store perawat extra data into `perawat` table if table exists
        $perawatRoleIds = $roleNames->filter(function($name){ return strtolower($name) === 'perawat'; })->keys();
        if ($perawatRoleIds->isNotEmpty()) {
            // validate perawat fields
            $perawatValidated = $request->validate([
                'perawat_alamat' => 'nullable|string|max:100',
                'perawat_no_hp' => 'nullable|string|max:45',
                'perawat_jenis_kelamin' => 'nullable|in:L,P',
                'perawat_pendidikan' => 'nullable|string|max:100',
            ]);

            if (Schema::hasTable('perawat')) {
                Perawat::create([
                    'alamat' => $perawatValidated['perawat_alamat'] ?? null,
                    'no_hp' => $perawatValidated['perawat_no_hp'] ?? null,
                    'jenis_kelamin' => $perawatValidated['perawat_jenis_kelamin'] ?? null,
                    'pendidikan' => $perawatValidated['perawat_pendidikan'] ?? null,
                    'id_user' => $user->iduser,
                ]);
                // DB::table('perawat')->insert([
                //     'alamat' => $perawatValidated['perawat_alamat'] ?? null,
                //     'no_hp' => $perawatValidated['perawat_no_hp'] ?? null,
                //     'jenis_kelamin' => $perawatValidated['perawat_jenis_kelamin'] ?? null,
                //     'pendidikan' => $perawatValidated['perawat_pendidikan'] ?? null,
                //     'id_user' => $userId,
                // ]);
            }
        }

        return redirect()->route('admin.datauser.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Optionally, you can implement a show view here. For now, just redirect as before.
        return redirect()->route('admin.datauser.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        // Option B: Implement a placeholder edit form view
        $user = DataUser::findOrFail($id);
        // $user = DB::table('user')->where('iduser', $id)->first();
        // if (!$user) {
        //     abort(404);
        // }
        $roles = Role::all();
        // $roles = DB::table('role')->get();
        $userRoles = $user->roles->pluck('idrole')->toArray();
        // $userRoles = DB::table('role_user')->where('iduser', $id)->pluck('idrole')->toArray();
        // Optionally, fetch extra data for pemilik/dokter/perawat if needed
        return view('admin.datauser.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $user = DataUser::findOrFail($id);
        // $user = DB::table('user')->where('iduser', $id)->first();
        // if (!$user) {
        //     abort(404);
        // }

        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:3',
            'email' => 'required|email|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:role,idrole',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        $updateData = [
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
        ];

        if (!empty($validatedData['password'])) {
            $updateData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($updateData);
        // DB::table('user')->where('iduser', $id)->update($updateData);

        // Update roles: remove role_user rows that were unselected, and ensure selected roles exist
        RoleUser::where('iduser', $id)
            ->whereNotIn('idrole', $validatedData['roles'])
            ->delete();
        // DB::table('role_user')->where('iduser', $id)
        //     ->whereNotIn('idrole', $validatedData['roles'])
        //     ->delete();

        foreach ($validatedData['roles'] as $roleId) {
            RoleUser::updateOrCreate(
                ['iduser' => $id, 'idrole' => $roleId],
                ['status' => 1]
            );
            // DB::table('role_user')->updateOrInsert(
            //     ['iduser' => $id, 'idrole' => $roleId],
            //     ['status' => 1]
            // );
        }

        // Map selected role ids to role names so we can react to role choices
        $roleNames = Role::whereIn('idrole', $validatedData['roles'])->pluck('nama_role', 'idrole');
        // $roleNames = DB::table('role')->whereIn('idrole', $validatedData['roles'])->pluck('nama_role', 'idrole');

        // If Pemilik role selected, update or insert pemilik data
        $pemilikRoleIds = $roleNames->filter(function($name){ return strtolower($name) === 'pemilik'; })->keys();
        if ($pemilikRoleIds->isNotEmpty()) {
            $pemilikValidated = $request->validate([
                'pemilik_no_wa' => 'nullable|string|max:45',
                'pemilik_alamat' => 'nullable|string|max:100',
            ]);

            if (Schema::hasTable('pemilik')) {
                Pemilik::updateOrCreate(
                    ['iduser' => $id],
                    [
                        'no_wa' => $pemilikValidated['pemilik_no_wa'] ?? null,
                        'alamat' => $pemilikValidated['pemilik_alamat'] ?? null,
                    ]
                );
                // DB::table('pemilik')->updateOrInsert(
                //     ['iduser' => $id],
                //     [
                //         'no_wa' => $pemilikValidated['pemilik_no_wa'] ?? null,
                //         'alamat' => $pemilikValidated['pemilik_alamat'] ?? null,
                //     ]
                // );
            }
        } else {
            // If pemilik role not selected, remove pemilik data if exists
            Pemilik::where('iduser', $id)->delete();
            // DB::table('pemilik')->where('iduser', $id)->delete();
        }

        // If Dokter role selected, update or insert dokter data
        $dokterRoleIds = $roleNames->filter(function($name){ return strtolower($name) === 'dokter'; })->keys();
        if ($dokterRoleIds->isNotEmpty()) {
            $dokterValidated = $request->validate([
                'dokter_alamat' => 'nullable|string|max:100',
                'dokter_no_hp' => 'nullable|string|max:45',
                'dokter_bidang_dokter' => 'nullable|string|max:100',
                'dokter_jenis_kelamin' => 'nullable|in:L,P',
            ]);

            if (Schema::hasTable('dokter')) {
                Dokter::updateOrCreate(
                    ['id_user' => $id],
                    [
                        'alamat' => $dokterValidated['dokter_alamat'] ?? null,
                        'no_hp' => $dokterValidated['dokter_no_hp'] ?? null,
                        'bidang_dokter' => $dokterValidated['dokter_bidang_dokter'] ?? null,
                        'jenis_kelamin' => $dokterValidated['dokter_jenis_kelamin'] ?? null,
                    ]
                );
                // DB::table('dokter')->updateOrInsert(
                //     ['id_user' => $id],
                //     [
                //         'alamat' => $dokterValidated['dokter_alamat'] ?? null,
                //         'no_hp' => $dokterValidated['dokter_no_hp'] ?? null,
                //         'bidang_dokter' => $dokterValidated['dokter_bidang_dokter'] ?? null,
                //         'jenis_kelamin' => $dokterValidated['dokter_jenis_kelamin'] ?? null,
                //     ]
                // );
            }
        } else {
            // If dokter role not selected, remove dokter data if exists
            Dokter::where('id_user', $id)->delete();
            // DB::table('dokter')->where('id_user', $id)->delete();
        }

        // If Perawat role selected, update or insert perawat data
        $perawatRoleIds = $roleNames->filter(function($name){ return strtolower($name) === 'perawat'; })->keys();
        if ($perawatRoleIds->isNotEmpty()) {
            $perawatValidated = $request->validate([
                'perawat_alamat' => 'nullable|string|max:100',
                'perawat_no_hp' => 'nullable|string|max:45',
                'perawat_jenis_kelamin' => 'nullable|in:L,P',
                'perawat_pendidikan' => 'nullable|string|max:100',
            ]);

            if (Schema::hasTable('perawat')) {
                Perawat::updateOrCreate(
                    ['id_user' => $id],
                    [
                        'alamat' => $perawatValidated['perawat_alamat'] ?? null,
                        'no_hp' => $perawatValidated['perawat_no_hp'] ?? null,
                        'jenis_kelamin' => $perawatValidated['perawat_jenis_kelamin'] ?? null,
                        'pendidikan' => $perawatValidated['perawat_pendidikan'] ?? null,
                    ]
                );
                // DB::table('perawat')->updateOrInsert(
                //     ['id_user' => $id],
                //     [
                //         'alamat' => $perawatValidated['perawat_alamat'] ?? null,
                //         'no_hp' => $perawatValidated['perawat_no_hp'] ?? null,
                //         'jenis_kelamin' => $perawatValidated['perawat_jenis_kelamin'] ?? null,
                //         'pendidikan' => $perawatValidated['perawat_pendidikan'] ?? null,
                //     ]
                // );
            }
        } else {
            // If perawat role not selected, remove perawat data if exists
            Perawat::where('id_user', $id)->delete();
            // DB::table('perawat')->where('id_user', $id)->delete();
        }

        return redirect()->route('admin.datauser.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = DataUser::findOrFail($id);
        $user->delete();
        // $user = DB::table('user')->where('iduser', $id)->first();
        // if (!$user) {
        //     abort(404);
        // }
        // DB::table('user')->where('iduser', $id)->delete();
        return redirect()->route('admin.datauser.index')->with('success', 'User deleted.');
    }
}
