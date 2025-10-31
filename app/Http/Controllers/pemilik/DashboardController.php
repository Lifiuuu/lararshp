<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session('user_role');
        $data = [
            'pets' => \App\Models\Pet::with('pemilik', 'rasHewan')->where('idpemilik', session('user_role'))->get(),
            'rekamMediss' => \App\Models\RekamMedis::with('temudokter.pet', 'roleUser.user')->whereHas('temudokter.pet', function($q) {
                $q->where('idpemilik', session('user_role'));
            })->get(),
        ];

        return view('pemilik.dashboard', compact('data', 'role'));
    }
}
