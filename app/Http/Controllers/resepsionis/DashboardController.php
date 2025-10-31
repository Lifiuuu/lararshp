<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');
        $data = [
            'pemiliks' => \App\Models\Pemilik::with('user')->get(),
            'pets' => \App\Models\Pet::with('pemilik', 'rasHewan')->get(),
            'temudokters' => \App\Models\TemuDokter::with('pet', 'dokter')->get(),
        ];

        return view('resepsionis.dashboard', compact('data', 'role'));
    }
}
