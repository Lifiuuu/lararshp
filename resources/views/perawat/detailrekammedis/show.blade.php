@extends('layouts.lte.main')

@section('content')
    <div class="container-fluid p-3">
        <div class="card">
            <div class="card-header">Detail Rekam Medis #{{ $rekam->idrekam_medis }}</div>
            <div class="card-body">
                <h5>Patient</h5>
                <p>
                    <strong>Pet:</strong> {{ $rekam->temuDokter->pet->nama ?? '-' }}<br>
                    <strong>Jenis kelamin:</strong>
                    @php
                        $jk = $rekam->temuDokter->pet->jenis_kelamin ?? null;
                        $jkLabel = $jk === 'J' ? 'Jantan' : ($jk === 'B' ? 'Betina' : '-');
                    @endphp
                    {{ $jkLabel }} <span class="small text-muted">({{ $jk ?? '-' }})</span><br>
                    <strong>Warna tanda:</strong> {{ $rekam->temuDokter->pet->warna_tanda ?? '-' }}<br>
                    <strong>Tanggal Lahir:</strong> {{ optional(\Carbon\Carbon::parse($rekam->temuDokter->pet->tanggal_lahir ?? null))->format('Y-m-d') ?? '-' }}<br>
                    <strong>Owner:</strong> {{ $rekam->temuDokter->pet->pemilik->user->nama ?? '-' }} ({{ $rekam->temuDokter->pet->pemilik->no_wa ?? '-' }})<br>
                    <strong>Dokter:</strong> {{ $rekam->roleUser->user->nama ?? '-' }}<br>
                    <strong>Waktu:</strong> {{ optional(\Carbon\Carbon::parse($rekam->temuDokter->waktu_daftar ?? $rekam->created_at))->format('Y-m-d H:i') ?? '-' }}
                </p>

                <h5>Clinical</h5>
                <p>
                    <strong>Anamnesa:</strong> {{ $rekam->anamnesa ?? '-' }}<br>
                    <strong>Temuan Klinis:</strong> {{ $rekam->temuan_klinis ?? '-' }}<br>
                    <strong>Diagnosa:</strong> {{ $rekam->diagnosa ?? '-' }}
                </p>

                <h5>Detail Tindakan</h5>
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Tindakan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($details as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $d->kodeTindakanTerapi->kode ?? '-' }}</td>
                                    <td>{{ $d->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>
                                    <td>{{ $d->detail ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No detail tindakan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <p><a href="{{ route('perawat.datarekammedis.index') }}" class="btn btn-sm btn-secondary">Back to Rekam Medis</a></p>
            </div>
        </div>
    </div>
@endsection
