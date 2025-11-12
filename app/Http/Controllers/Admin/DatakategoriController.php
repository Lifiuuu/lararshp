<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class DatakategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.datakategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.datakategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatekategori($request);

        $kategori = $this->createkategori($validatedData);

        return redirect()->route('admin.datakategori.index')
                            ->with('success', 'Data created successfully.');
    }

    protected function validatekategori(Request $request, $id=null){

        $uniqueRule = $id ? 
            'unique:kategori,nama_kategori,' . $id . ',idkategori':
            'unique:kategori,nama_kategori';
        return $request->validate([
            'nama_kategori' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule
            ],
        ],
        [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa string.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada dalam database.',
        ]
    
    );
    }

    protected function createkategori(array $data){
        try {
            return Kategori::create([
                'nama_kategori' => normalize_name($data['nama_kategori']),
            ]);
        } catch (\Exception $e) {
            // Handle exception, log error, etc.
            throw $e;
        }
    }

    public function show($id)
    {
        return redirect()->route('admin.datakategori.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.datakategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.datakategori.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.datakategori.index')->with('success', 'Data deleted.');
    }
}
