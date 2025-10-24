<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenishewanController extends Controller
{
    public function index()
    {
        $jenisHewans = JenisHewan::all();
        return view('admin.jenishewan.index', compact('jenisHewans'));
    }
}
