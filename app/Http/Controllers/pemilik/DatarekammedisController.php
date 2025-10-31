<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $rekamMediss = RekamMedis::with('temuDokter.pet', 'roleUser.user')->whereHas('temuDokter.pet', function($q) {
            $q->where('idpemilik', session('user_role'));
        })->get();
        return view('pemilik.rekammedis.index', compact('rekamMediss'));
    }
}
