<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatatindakanController extends Controller
{
    public function index()
    {
        $tindakans = DB::table('kode_tindakan_terapi as k')
            ->leftJoin('kategori as kat', 'k.idkategori', '=', 'kat.idkategori')
            ->leftJoin('kategori_klinis as kk', 'k.idkategori_klinis', '=', 'kk.idkategori_klinis')
            ->select('k.*', 'kat.nama_kategori', 'kk.nama_kategori_klinis')
            ->get();

        return view('admin.datatindakan.index', compact('tindakans'));
    }
}
