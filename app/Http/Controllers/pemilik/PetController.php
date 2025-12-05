<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $pets = Pet::with('pemilik', 'rasHewan')->where('idpemilik', $pemilik->idpemilik)->get();

        // $pets = DB::table('pet as p')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
        //     ->select('p.*', 'pm.no_wa as pemilik_no_wa', 'pm.alamat as pemilik_alamat', 'r.nama_ras')
        //     ->where('p.idpemilik', $pemilik->idpemilik)
        //     ->get();

        return view('pemilik.pet.index', compact('pets'));
    }
}
