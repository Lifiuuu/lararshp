<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RekamMedis;

class DatarekammedisController extends Controller
{
    public function index()
    {
        $rekamMediss = RekamMedis::with('pet', 'roleUser')->get();
        return view('admin.datarekammedis.index', compact('rekamMediss'));
    }
}
