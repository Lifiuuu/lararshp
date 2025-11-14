@extends('layouts.lte.main')

@section('content')
<section class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Daftar Data Kategori</h1>
    <div style="text-align:right;">
            <a href="{{ route('admin.datakategori.create') }}" class="btn-admin primary" style="text-align:left">Tambah Kategori</a>
    </div>
    <div class="table-responsive">
        <table class="admin-table table-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama Kategori</th>
                <th class="text-right py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $index => $kategori)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                <td class="py-2 px-4 border-b">{{ $kategori->nama_kategori }}</td>
                <td class="actions">
                    <a href="{{ route('admin.datakategori.edit', $kategori->idkategori) }}" class="btn-admin ghost">Edit</a>
                    <form action="{{ route('admin.datakategori.destroy', $kategori->idkategori) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus kategori ini?')">
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
