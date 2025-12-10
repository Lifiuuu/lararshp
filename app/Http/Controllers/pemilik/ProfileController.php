<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')->with('error', 'Data pemilik tidak ditemukan.');
        }

        return view('pemilik.profile.edit', compact('user', 'pemilik'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser',
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
        ]);

        // Update user
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        // Update pemilik
        $pemilik->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('pemilik.profile.edit')->with('success', 'Profile updated successfully.');
    }
}