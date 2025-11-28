@extends('layouts.lte.main')

@section('page-title', 'Jenis Hewan')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.jenishewan.create') }}" class="btn btn-primary">Tambah Jenis Hewan</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama Jenis Hewan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jenisHewans as $index => $jenisHewan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $jenisHewan->nama_jenis_hewan }}</td>
                            <td class="text-center actions">
                                <a href="{{ route('admin.jenishewan.edit', $jenisHewan->id ?? $jenisHewan->kode ?? $jenisHewan->nama_jenis_hewan) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                <form action="{{ route('admin.jenishewan.destroy', $jenisHewan->id ?? $jenisHewan->kode ?? $jenisHewan->nama_jenis_hewan) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus jenis hewan ini?')">
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
