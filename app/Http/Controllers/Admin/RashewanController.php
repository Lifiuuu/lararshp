<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;

class RashewanController extends Controller
{
    public function index()
    {
        $rasHewans = RasHewan::with('jenisHewan')->get();
        return view('admin.rashewan.index', compact('rasHewans'));
    }
}
