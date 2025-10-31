<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;

class TemudokterController extends Controller
{
    public function index()
    {
        $temudokters = TemuDokter::with('pet', 'dokter')->get();
        return view('resepsionis.temudokter.index', compact('temudokters'));
    }
}
