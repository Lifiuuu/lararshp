@extends('layouts.lte.main')

@section('page-title', 'Data Rekam Medis')

@section('breadcrumb')
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('admin.datarekammedis.create') }}" class="btn btn-primary">Tambah Rekam Medis</a>
    </div>
    <div class="card">
        
        <div class="card-body table-responsive">
            <table class="table table-striped table-sm actions align-middle">
                <thead>
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pet</th>
                        <th>Dokter</th>
                        <th>Waktu Daftar</th>
                        <th>Anamnesa</th>
                        <th>Temuan Klinis</th>
                        <th>Diagnosa</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMediss as $i => $rm)
                        <tr>
                                <td>{{ $rm->temuDokter->no_urut ?? '-' }}</td>
                                <td>
                                    <strong>{{ $rm->temuDokter->pet->nama ?? '-' }}</strong>
                                    <div class="small text-muted">Owner: {{ $rm->temuDokter->pet->pemilik->user->nama ?? '-' }}</div>
                                    <div class="small text-muted">Contact: {{ $rm->temuDokter->pet->pemilik->no_wa ?? '-' }}</div>
                                </td>
                                <td>{{ $rm->roleUser->user->nama ?? '-' }}</td>
                                <td>{{ optional(\Carbon\Carbon::parse($rm->temuDokter->waktu_daftar ?? $rm->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
                                <td title="{{ $rm->anamnesa ?? '-' }}">{{ Str::limit($rm->anamnesa ?? '-', 5) }}</td>
                                <td title="{{ $rm->temuan_klinis ?? '-' }}">{{ Str::limit($rm->temuan_klinis ?? '-', 5) }}</td>
                                <td title="{{ $rm->diagnosa ?? '-' }}">{{ Str::limit($rm->diagnosa ?? '-', 5) }}</td>
                                <td class="actions">
                                    <a href="{{ route('admin.datarekammedis.edit', $rm->idrekam_medis) }}" class="btn btn-sm btn-warning btn-admin sm">Edit</a>
                                    <form action="{{ route('admin.datarekammedis.destroy', $rm->idrekam_medis) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-admin sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
