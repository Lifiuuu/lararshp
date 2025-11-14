@extends('layouts.lte.main')

@section('content')
<section class="admin-content container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Jenis Hewan</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.jenishewan.create') }}" class="btn-admin primary" style="text-align:left">Tambah Jenis Hewan</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b text-center">No</th>
                <th class="py-2 px-4 border-b text-center">Nama Jenis Hewan</th>
                <th class="py-2 px-4 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jenisHewans as $index => $jenisHewan)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $jenisHewan->nama_jenis_hewan }}</td>
                <td class="actions">
                    <a href="{{ route('admin.jenishewan.edit', $jenisHewan->id ?? $jenisHewan->kode ?? $jenisHewan->nama_jenis_hewan) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.jenishewan.destroy', $jenisHewan->id ?? $jenisHewan->kode ?? $jenisHewan->nama_jenis_hewan) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus jenis hewan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-admin warn">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</section>
@endsection
