@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">Data Rekam Medis — Perawat</div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
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
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <strong>{{ $rm->nama_pet ?? '-' }}</strong>
                                        <div class="small text-muted">Owner: {{ $rm->nama_pemilik ?? '-' }}</div>
                                        <div class="small text-muted">Contact: {{ $rm->pemilik_no_wa ?? '-' }}</div>
                                    </td>
                                    <td>{{ $rm->nama_dokter ?? '-' }}</td>
                                    <td>{{ optional(\Carbon\Carbon::parse($rm->waktu_daftar ?? $rm->created_at ?? $rm->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
                                    <td>{{ $rm->anamnesa ?? '-' }}</td>
                                    <td>{{ $rm->temuan_klinis ?? '-' }}</td>
                                    <td>{{ $rm->diagnosa ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('perawat.detailrekammedis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-primary">View</a>
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