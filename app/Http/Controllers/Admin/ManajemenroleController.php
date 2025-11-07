<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class ManajemenroleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.manajemenrole.index', compact('roles'));
    }

    public function create()
    {
        return redirect()->route('admin.manajemenrole.index')->with('info', 'Create form not implemented yet.');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.manajemenrole.index')->with('info', 'Store not implemented yet.');
    }

    public function show($id)
    {
        return redirect()->route('admin.manajemenrole.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.manajemenrole.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.manajemenrole.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.manajemenrole.index')->with('success', 'Role deleted.');
    }
}
