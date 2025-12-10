<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $perawat = Perawat::where('id_user', $user->iduser)->first();

        if (!$perawat) {
            return redirect()->route('perawat.dashboard')->with('error', 'Data perawat tidak ditemukan.');
        }

        return view('perawat.profile.edit', compact('user', 'perawat'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $perawat = Perawat::where('id_user', $user->iduser)->first();

        if (!$perawat) {
            return redirect()->route('perawat.dashboard')->with('error', 'Data perawat tidak ditemukan.');
        }

        $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100',
        ]);

        // Update user
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        // Update perawat
        $perawat->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pendidikan' => $request->pendidikan,
        ]);

        return redirect()->route('perawat.profile.edit')->with('success', 'Profile updated successfully.');
    }
}