<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;

class DatapemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->get();
        return view('admin.datapemilik.index', compact('pemiliks'));
    }
}
