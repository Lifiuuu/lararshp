@extends('layouts.lte.main')

@section('page-title', 'Data Kategori')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datakategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $index => $kategori)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td class="text-center actions">
                                <a href="{{ route('admin.datakategori.edit', $kategori->idkategori) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                <form action="{{ route('admin.datakategori.destroy', $kategori->idkategori) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus kategori ini?')">
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
