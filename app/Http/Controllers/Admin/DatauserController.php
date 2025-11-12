<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataUser;
use App\Models\Pemilik;
use App\Models\Role;
use App\Models\RoleUser;

class DatauserController extends Controller
{
    public function index()
    {
        $users = DataUser::with('roles', 'pemilik')->get();
        return view('admin.datauser.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
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

        foreach ($validatedData['roles'] as $roleId) {
            RoleUser::create([
                'iduser' => $user->iduser,
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
        $user = DataUser::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.datauser.index')->with('success', 'User deleted.');
    }
}
