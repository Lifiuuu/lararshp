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
}
