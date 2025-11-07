@extends('layouts.admin.admin')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Tindakan</h1>
    <div style="text-align:right; padding-bottom:10px;">
        <a href="{{ route('admin.datatindakan.create') }}" class="btn-admin primary" style="text-align:left">Tambah Data Tindakan</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Kode</th>
                <th class="py-2 px-4 border-b">Deskripsi Tindakan Terapi</th>
                <th class="py-2 px-4 border-b">Kategori</th>
                <th class="py-2 px-4 border-b">Kategori Klinis</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tindakans as $index => $tindakan)
            <tr>
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->kode }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->deskripsi_tindakan_terapi }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->kategori->nama_kategori ?? 'N/A' }}</td>
                <td class="py-2 px-4 border-b">{{ $tindakan->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
                <td class="actions">
                    <a href="{{ route('admin.datatindakan.edit', $tindakan->id ?? $tindakan->kode) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.datatindakan.destroy', $tindakan->id ?? $tindakan->kode) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus tindakan ini?')">
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
