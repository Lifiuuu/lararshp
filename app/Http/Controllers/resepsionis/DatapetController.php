<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;

class DatapetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('pemilik.user', 'rasHewan')->get();

        // $pets = DB::table('pet as p')
        //     ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        //     ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
        //     ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
        //     ->select('p.*', 'u.nama as nama_pemilik', 'pm.no_wa as pemilik_no_wa', 'r.nama_ras')
        //     ->get();

        return view('resepsionis.datapet.index', compact('pets'));
    }

    public function create()
    {
        $pemiliks = Pemilik::with('user')->get();

        $rasHewans = RasHewan::with('jenisHewan')->get();

        return view('resepsionis.datapet.create', compact('pemiliks', 'rasHewans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:2',
            'jenis_kelamin' => 'required|in:J,B',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:255',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        Pet::create($validatedData);

        // DB::table('pet')->insert($validatedData);

        return redirect()->route('resepsionis.datapet.index')->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);

        // $pet = DB::table('pet')->where('idpet', $id)->first();
        // if (!$pet) abort(404);

        $pemiliks = Pemilik::with('user')->get();

        $rasHewans = RasHewan::with('jenisHewan')->get();

        return view('resepsionis.datapet.edit', compact('pet', 'pemiliks', 'rasHewans'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:2',
            'jenis_kelamin' => 'required|in:J,B',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:255',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        $pet = Pet::findOrFail($id);
        $pet->update($validatedData);

        // $pet = DB::table('pet')->where('idpet', $id)->first();
        // if (!$pet) abort(404);

        // DB::table('pet')->where('idpet', $id)->update($validatedData);

        return redirect()->route('resepsionis.datapet.index')->with('success', 'Data pet diperbarui.');
    }

    public function destroy($id)
    {
        Pet::findOrFail($id)->delete();

        // $pet = DB::table('pet')->where('idpet', $id)->first();
        // if (!$pet) abort(404);
        // DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('resepsionis.datapet.index')->with('success', 'Data deleted.');
    }
}
