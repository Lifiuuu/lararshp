<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class DatakategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.datakategori.index', compact('kategoris'));
    }
}
