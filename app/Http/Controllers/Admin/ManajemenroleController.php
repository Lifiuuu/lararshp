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
}
