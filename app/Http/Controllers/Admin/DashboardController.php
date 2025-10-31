<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');
        $data = [
            'kategoris' => \App\Models\Kategori::all(),
            'kategoriKliniss' => \App\Models\KategoriKlinis::all(),
            'jenisHewans' => \App\Models\JenisHewan::all(),
            'rasHewans' => \App\Models\RasHewan::with('jenisHewan')->get(),
            'roles' => \App\Models\Role::all(),
            'users' => \App\Models\DataUser::with('roles', 'pemilik')->get(),
            'pemiliks' => \App\Models\Pemilik::with('user')->get(),
            'pets' => \App\Models\Pet::with('pemilik', 'rasHewan')->get(),
            'rekamMediss' => \App\Models\RekamMedis::with('temuDokter.pet', 'roleUser.user')->get(),
            'tindakans' => \App\Models\KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get()
        ];

        return view('admin.dashboard', compact('data', 'role'));
    }
}
