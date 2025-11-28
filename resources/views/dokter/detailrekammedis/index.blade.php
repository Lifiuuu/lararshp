@extends('layouts.lte.main')

@section('page-title', request('rekam_medis') ? 'Detail Tindakan Rekam Medis ' . request('rekam_medis') : 'Detail Rekam Medis')

@section('breadcrumb')
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                
                <div class="card-body table-responsive">
                    <table class="table table-striped table-sm actions align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pet</th>
                                <th>Waktu Daftar</th>
                                <th>Kode Tindakan</th>
                                <th>Deskripsi Tindakan</th>
                                <th>Kategori</th>
                                <th>Kategori Klinis</th>
                                <th>Detail</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($details as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $d->nama_pet ?? '-' }}</td>
                                    <td>{{ optional(\Carbon\Carbon::parse($d->waktu_daftar))->format('Y-m-d H:i') ?? '-' }}</td>
                                    <td>{{ $d->kode }}</td>
                                    <td title="{{ $d->deskripsi_tindakan_terapi }}">{{ Str::limit($d->deskripsi_tindakan_terapi, 30) }}</td>
                                    <td>{{ $d->nama_kategori ?? '-' }}</td>
                                    <td>{{ $d->nama_kategori_klinis ?? '-' }}</td>
                                    <td title="{{ $d->detail }}">{{ Str::limit($d->detail, 30) }}</td>
                                    <td class="actions">
                                        <a href="{{ route('dokter.detailrekammedis.edit', $d->iddetail_rekam_medis) }}" class="btn btn-sm btn-warning btn-admin sm">Edit</a>
                                        <form action="{{ route('dokter.detailrekammedis.destroy', $d->iddetail_rekam_medis) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-admin sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">{{ request('rekam_medis') ? 'No detail tindakan found for this rekam medis.' : 'No detail rekam medis found.' }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection