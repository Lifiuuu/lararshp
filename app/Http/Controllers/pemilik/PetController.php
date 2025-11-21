<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function index()
    {
        $pets = DB::table('pet as p')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->select('p.*', 'pm.no_wa as pemilik_no_wa', 'pm.alamat as pemilik_alamat', 'r.nama_ras')
            ->where('p.idpemilik', session('user_role'))
            ->get();

        return view('pemilik.pet.index', compact('pets'));
    }
}
