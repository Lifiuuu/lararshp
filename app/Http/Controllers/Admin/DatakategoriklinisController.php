<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class DatakategoriklinisController extends Controller
{
    public function index()
    {
        $kategoriKliniss = KategoriKlinis::all();
        return view('admin.datakategoriklinis.index', compact('kategoriKliniss'));
    }
}
