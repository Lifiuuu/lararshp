<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;

class DatatindakanController extends Controller
{
    public function index()
    {
        $tindakans = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        return view('admin.datatindakan.index', compact('tindakans'));
    }
}
