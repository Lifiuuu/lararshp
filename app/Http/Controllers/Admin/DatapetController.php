<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class DatapetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik', 'rasHewan')->get();
        return view('admin.datapet.index', compact('pets'));
    }
}
