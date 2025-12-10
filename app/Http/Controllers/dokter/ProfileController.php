<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $dokter = Dokter::where('id_user', $user->iduser)->first();

        if (!$dokter) {
            return redirect()->route('dokter.dashboard')->with('error', 'Data dokter tidak ditemukan.');
        }

        return view('dokter.profile.edit', compact('user', 'dokter'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $dokter = Dokter::where('id_user', $user->iduser)->first();

        if (!$dokter) {
            return redirect()->route('dokter.dashboard')->with('error', 'Data dokter tidak ditemukan.');
        }

        $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser',
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'bidang_dokter' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        // Update user
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        // Update dokter
        $dokter->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'bidang_dokter' => $request->bidang_dokter,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('dokter.profile.edit')->with('success', 'Profile updated successfully.');
    }
}