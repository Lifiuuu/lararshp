@extends('layouts.lte.main')

@section('page-title', 'Data Dokter')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datadokter.create') }}" class="btn btn-primary">Tambah Data Dokter</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Bidang Dokter</th>
                            <th>Jenis Kelamin</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dokters as $index => $dokter)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $dokter->user_name ?? 'N/A' }}</td>
                            <td>{{ $dokter->alamat ?? '' }}</td>
                            <td>{{ $dokter->no_hp ?? '' }}</td>
                            <td>{{ $dokter->bidang_dokter ?? '' }}</td>
                            <td>{{ $dokter->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="text-center actions">
                                <a href="{{ route('admin.datadokter.edit', $dokter->id_dokter) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                <form action="{{ route('admin.datadokter.destroy', $dokter->id_dokter) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus dokter ini?')">
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