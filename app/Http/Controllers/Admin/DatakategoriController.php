<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class DatakategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::whereNull('deleted_at')->get();
        // $kategoris = DB::table('kategori')->get();
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
            // Some database dumps use tables without AUTO_INCREMENT on the PK.
            // If `idkategori` is not auto-incrementing, insert with an explicit id (max+1).
            $max = DB::table('kategori')->max('idkategori');
            $nextId = $max ? $max + 1 : 1;

            DB::table('kategori')->insert([
                'idkategori' => $nextId,
                'nama_kategori' => normalize_name($data['nama_kategori']),
            ]);

            return Kategori::find($nextId);
            // $id = DB::table('kategori')->insertGetId([
            //     'nama_kategori' => normalize_name($data['nama_kategori']),
            // ]);
            // return (object)['idkategori' => $id, 'nama_kategori' => normalize_name($data['nama_kategori'])];
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
        // $kategori = DB::table('kategori')->where('idkategori', $id)->first();
        // if (!$kategori) {
        //     abort(404);
        // }
        return view('admin.datakategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validatekategori($request, $id);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = normalize_name($validatedData['nama_kategori']);
        $kategori->save();

        return redirect()->route('admin.datakategori.index')->with('success', 'Data kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        // $kategori = DB::table('kategori')->where('idkategori', $id)->first();
        // if (!$kategori) {
        //     abort(404);
        // }
        // DB::table('kategori')->where('idkategori', $id)->delete();
        return redirect()->route('admin.datakategori.index')->with('success', 'Data deleted.');
    }
}
