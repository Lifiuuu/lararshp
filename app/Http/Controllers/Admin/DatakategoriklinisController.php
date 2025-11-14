<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;
use Illuminate\Support\Facades\DB;

class DatakategoriklinisController extends Controller
{
    public function index()
    {
        // $kategoriKliniss = KategoriKlinis::all();
        $kategoriKliniss = DB::table('kategori_klinis')->get();
        return view('admin.datakategoriklinis.index', compact('kategoriKliniss'));
    }

    public function create()
    {
        return view('admin.datakategoriklinis.create');
    }


    public function store(Request $request)
    {
        $validatedData = $this->validatekategoriklinis($request);

        $kategoriKlinis = $this->createkategoriklinis($validatedData);

        return redirect()->route('admin.datakategoriklinis.index')
                            ->with('success', 'Data created successfully.');
    }

    protected function validatekategoriklinis(Request $request, $id=null){

        $uniqueRule = $id ? 
            'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis':
            'unique:kategori_klinis,nama_kategori_klinis';
        return $request->validate([
            'nama_kategori_klinis' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule
            ],
        ],
        [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa string.',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter.',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada dalam database.',
        ]
    
    );
    }
    protected function createkategoriklinis(array $data){
        try {
            // return KategoriKlinis::create([
            //     'nama_kategori_klinis' => normalize_name($data['nama_kategori_klinis']),
            // ]);
            $id = DB::table('kategori_klinis')->insertGetId([
                'nama_kategori_klinis' => normalize_name($data['nama_kategori_klinis']),
            ]);
            return (object)['idkategori_klinis' => $id, 'nama_kategori_klinis' => normalize_name($data['nama_kategori_klinis'])];
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori klinis: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        return redirect()->route('admin.datakategoriklinis.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.datakategoriklinis.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datakategoriklinis.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        // $kategori = KategoriKlinis::findOrFail($id);
        // $kategori->delete();
        $kategori = DB::table('kategori_klinis')->where('idkategori_klinis', $id)->first();
        if (!$kategori) {
            abort(404);
        }
        DB::table('kategori_klinis')->where('idkategori_klinis', $id)->delete();
        return redirect()->route('admin.datakategoriklinis.index')->with('success', 'Data deleted.');
    }
}
