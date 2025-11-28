@extends('layouts.lte.main')

@section('page-title', 'Data Rekam Medis')

@section('breadcrumb')
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped table-sm actions align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pet</th>
                        <th>Waktu Daftar</th>
                        <th>Anamnesa</th>
                        <th>Temuan Klinis</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMediss as $i => $rm)
                        <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <strong>{{ $rm->nama_pet ?? '-' }}</strong>
                                    <div class="small text-muted">Owner: {{ $rm->nama_pemilik ?? '-' }}</div>
                                    <div class="small text-muted">Contact: {{ $rm->pemilik_no_wa ?? '-' }}</div>
                                </td>
                                <td>{{ optional(\Carbon\Carbon::parse($rm->waktu_daftar ?? $rm->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
                                <td title="{{ $rm->anamnesa ?? '-' }}">{{ Str::limit($rm->anamnesa ?? '-', 5) }}</td>
                                <td title="{{ $rm->temuan_klinis ?? '-' }}">{{ Str::limit($rm->temuan_klinis ?? '-', 5) }}</td>
                                <td title="{{ $rm->diagnosa ?? '-' }}">{{ Str::limit($rm->diagnosa ?? '-', 5) }}</td>
                                <td class="actions align-middle text-center">
                                    <a href="{{ route('dokter.detailrekammedis.index', ['rekam_medis' => $rm->idrekam_medis]) }}" class="btn btn-sm btn-info btn-admin sm">Lihat Tindakan</a>
                                </td>
                                <td class="actions align-middle text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <a href="{{ route('dokter.detailrekammedis.create', $rm->idrekam_medis) }}" class="btn btn-sm btn-primary btn-admin sm mb-2">Tambah Tindakan</a>
                                        <form action="{{ route('dokter.datarekammedis.complete', $rm->idrekam_medis) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success btn-admin sm" onclick="return confirm('Apakah Anda yakin ingin menyelesaikan temu dokter ini?')">Selesai</button>
                                        </form>
                                    </div>
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