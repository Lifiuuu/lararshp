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
        return redirect()->route('admin.datauser.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.datauser.index')->with('info', 'Store not implemented yet.');
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
