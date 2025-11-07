<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisHewan;

class JenishewanController extends Controller
{
    public function index()
    {
        $jenisHewans = JenisHewan::all();
        return view('admin.jenishewan.index', compact('jenisHewans'));
    }

    public function create()
    {
        return view('admin.jenishewan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatejenishewan($request);

        $jenisHewan = $this->createjenishewan($validatedData);

        return redirect()->route('admin.jenishewan.index')
                            ->with('success', 'Jenis hewan created successfully.');
    }
    protected function validatejenishewan(Request $request, $id=null){

        $uniqueRule = $id ? 
            'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan':
            'unique:jenis_hewan,nama_jenis_hewan';


        return $request->validate([
            'nama_jenis_hewan' => [
                'required', 
                'string', 
                'max:255', 
                'min:3', 
                $uniqueRule
            ],
        ],
        [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa string.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada dalam database.',
        ]
    
    );
    }

    protected function createjenishewan(array $data){
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('gagal menyimpan data jenis hewan: ' . $e->getMessage());
        }
    }

    protected function formatNamaJenisHewan($nama){
        return trim(ucwords(strtolower($nama)));
    }

    public function show($id)
    {
        return redirect()->route('admin.jenishewan.index')->with('info', 'Show not implemented yet.');
    }

    public function edit($id)
    {
        return redirect()->route('admin.jenishewan.index')->with('info', 'Edit form not implemented yet.');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('admin.jenishewan.index')->with('info', 'Update not implemented yet.');
    }

    public function destroy($id)
    {
        $jenis = JenisHewan::findOrFail($id);
        $jenis->delete();
        return redirect()->route('admin.jenishewan.index')->with('success', 'Data deleted.');
    }
}
