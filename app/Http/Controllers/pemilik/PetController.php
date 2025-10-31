<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik', 'rasHewan')->where('idpemilik', session('user_role'))->get();
        return view('pemilik.pet.index', compact('pets'));
    }
}
