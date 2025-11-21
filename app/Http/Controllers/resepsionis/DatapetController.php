<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatapetController extends Controller
{
    public function index()
    {
        $pets = DB::table('pet as p')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->select('p.*', 'u.nama as nama_pemilik', 'pm.no_wa as pemilik_no_wa', 'r.nama_ras')
            ->get();

        return view('admin.datapet.index', compact('pets'));
    }

    public function create()
    {
        $pemiliks = DB::table('pemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.*', 'user.nama as nama_user')
            ->get();

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

        DB::table('pet')->insert($validatedData);

        return redirect()->route('admin.datapet.index')->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = DB::table('pet')->where('idpet', $id)->first();
        if (!$pet) abort(404);

        $pemiliks = DB::table('pemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.*', 'user.nama as nama_user')
            ->get();

        $rasHewans = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->get();

        return view('admin.datapet.edit', compact('pet', 'pemiliks', 'rasHewans'));
    }

    public function update(Request $request, $id)
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

        $pet = DB::table('pet')->where('idpet', $id)->first();
        if (!$pet) abort(404);

        DB::table('pet')->where('idpet', $id)->update($validatedData);

        return redirect()->route('admin.datapet.index')->with('success', 'Data pet diperbarui.');
    }

    public function destroy($id)
    {
        $pet = DB::table('pet')->where('idpet', $id)->first();
        if (!$pet) abort(404);
        DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('admin.datapet.index')->with('success', 'Data deleted.');
    }
}
