@extends('layouts.lte.main')

@section('page-title', 'Data Perawat')

@section('content')
<section class="container mx-auto p-4">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.dataperawat.create') }}" class="btn btn-primary">Tambah Data Perawat</a>
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
                            <th>Jenis Kelamin</th>
                            <th>Pendidikan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($perawats as $index => $perawat)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $perawat->user->nama ?? 'N/A' }}</td>
                            <td>{{ $perawat->alamat ?? '' }}</td>
                            <td>{{ $perawat->no_hp ?? '' }}</td>
                            <td>{{ $perawat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $perawat->pendidikan ?? '' }}</td>
                            <td class="text-center actions">
                                <a href="{{ route('admin.dataperawat.edit', $perawat->id_perawat) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                <form action="{{ route('admin.dataperawat.destroy', $perawat->id_perawat) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Hapus perawat ini?')">
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