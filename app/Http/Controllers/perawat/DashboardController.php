<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');
        $data = [
            'rekamMediss' => \App\Models\RekamMedis::with('temuDokter.pet', 'roleUser.user')->get(),
            'tindakans' => \App\Models\KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get(),
        ];

        return view('perawat.dashboard', compact('data', 'role'));
    }
}
