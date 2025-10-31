<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $rekamMediss = RekamMedis::with('temuDokter.pet', 'roleUser.user')->get();
        return view('admin.datarekammedis.index', compact('rekamMediss'));
    }
}
