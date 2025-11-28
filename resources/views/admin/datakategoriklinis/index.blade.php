@extends('layouts.lte.main')

@section('page-title', 'Data Kategori Klinis')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datakategoriklinis.create') }}" class="btn btn-primary">Tambah Kategori Klinis</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori Klinis</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoriKliniss as $index => $kategoriKlinis)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $kategoriKlinis->nama_kategori_klinis }}</td>
                            <td class="text-center actions">
                                <a href="{{ route('admin.datakategoriklinis.edit', $kategoriKlinis->id ?? $kategoriKlinis->idkategori_klinis ?? $kategoriKlinis->nama_kategori_klinis) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                <form action="{{ route('admin.datakategoriklinis.destroy', $kategoriKlinis->id ?? $kategoriKlinis->idkategori_klinis ?? $kategoriKlinis->nama_kategori_klinis) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus kategori klinis ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
