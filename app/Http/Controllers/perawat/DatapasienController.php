<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;

class DatapasienController extends Controller
{
    /**
     * Display a listing of the patients (pets) with owner name.
     */
    public function index()
    {
        $pets = Pet::with('pemilik.user', 'rasHewan')->get();

        // $pets = DB::table('pet as p')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
        //     ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
        //     ->select('p.*', 'u.nama as nama_pemilik', 'pm.no_wa as pemilik_no_wa', 'r.nama_ras')
        //     ->get();

        return view('perawat.datapasien.index', compact('pets'));
    }
}
