@extends('layouts.lte.main')

@section('page-title', 'Data Pemilik')

@section('content')
<section class="container-fluid p-4">
    <div class="d-flex justify-content-start mb-3">
                <a href="{{ route('admin.datapemilik.create') }}" class="btn btn-primary me-3">Tambah Data Pemilik</a>
    </div>
    <div class="card w-100">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama</th>
                                    <th>No WA</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pemiliks as $index => $pemilik)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $pemilik->nama_user ?? 'N/A' }}</td>
                                    <td>{{ $pemilik->no_wa ?? '' }}</td>
                                    <td>{{ $pemilik->alamat ?? '' }}</td>
                                    <td class="text-center actions">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.datapemilik.edit', $pemilik->idpemilik) }}" class="btn btn-sm btn-warning me-1 btn-admin sm">Edit</a>
                                            <form action="{{ route('admin.datapemilik.destroy', $pemilik->idpemilik) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pemilik ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-admin sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
