<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUser;
use App\Models\Pemilik;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\DB;

class DatauserController extends Controller
{
    public function index()
    {
        // $users = DataUser::with('roles', 'pemilik')->get();
        // Use query builder to fetch user rows joined with role rows (may create multiple rows per user
        // when users have multiple roles). We normalize the result into one object per user and
        // attach a `roles` collection so views that expect `$user->roles` continue to work.
        $rawRows = DB::table('user')
            ->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->leftJoin('pemilik', 'user.iduser', '=', 'pemilik.iduser')
            ->select('user.*', 'role.nama_role', 'user.nama as nama_pemilik', 'pemilik.no_wa as pemilik_no_wa')
            ->get();

        // Group rows by user id and fold rows into a single user object with a `roles` collection
        $users = $rawRows->groupBy('iduser')->map(function ($rows) {
            $first = $rows->first();
            $roles = $rows->pluck('nama_role')->filter()->unique()->map(function ($name) {
                return (object)['nama_role' => $name];
            })->values();
            // attach roles collection to the user object
            $first->roles = $roles;
            return $first;
        })->values();
        return view('admin.datauser.index', compact('users'));
    }

    public function create()
    {
        // $roles = Role::all();
        $roles = DB::table('role')->get();
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

        // $user = DataUser::create([
        //     'nama' => $validatedData['nama'],
        //     'email' => $validatedData['email'],
        //     'password' => $validatedData['password'],
        // ]);
        $userId = DB::table('user')->insertGetId([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        foreach ($validatedData['roles'] as $roleId) {
            // RoleUser::create([
            //     'iduser' => $user->iduser,
            //     'idrole' => $roleId,
            //     'status' => 'active',
            // ]);
            DB::table('role_user')->insert([
                'iduser' => $userId,
                'idrole' => $roleId,
                'status' => 'active',
            ]);
        }

        return redirect()->route('admin.datauser.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.datauser.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datauser.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datauser.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        // $user = DataUser::findOrFail($id);
        // $user->delete();
        $user = DB::table('user')->where('iduser', $id)->first();
        if (!$user) {
            abort(404);
        }
        DB::table('user')->where('iduser', $id)->delete();
        return redirect()->route('admin.datauser.index')->with('success', 'User deleted.');
    }
}
