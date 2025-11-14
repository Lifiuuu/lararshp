<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class DatapetController extends Controller
{
    public function index()
    {
        // $pets = Pet::with('pemilik', 'rasHewan')->get();
        $pets = DB::table('pet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            // pemilik table does not have `nama`; owner name lives in `user.nama`
            ->select('pet.*', 'user.nama as nama_pemilik', 'pemilik.no_wa as pemilik_no_wa', 'ras_hewan.nama_ras')
            ->get();
        return view('admin.datapet.index', compact('pets'));
    }

    public function create()
    {
        // eager load user to be able to show owner's name in dropdown
        // $pemiliks = \App\Models\Pemilik::with('user')->get();
        $pemiliks = DB::table('pemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.*', 'user.nama as nama_user')
            ->get();
        
        // $rasHewans = \App\Models\RasHewan::with('jenisHewan')->get();
        $rasHewans = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->get();
        return view('admin.datapet.create', compact('pemiliks', 'rasHewans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255|min:2',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:255',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $validatedData['nama'] = normalize_name($validatedData['nama']);

        // Pet::create($validatedData);
        DB::table('pet')->insert($validatedData);

        return redirect()->route('admin.datapet.index')->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function show($id)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datapet.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        // $pet = Pet::findOrFail($id);
        // $pet->delete();
        $pet = DB::table('pet')->where('idpet', $id)->first();
        if (!$pet) {
            abort(404);
        }
        DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('admin.datapet.index')->with('success', 'Data deleted.');
    }
}
