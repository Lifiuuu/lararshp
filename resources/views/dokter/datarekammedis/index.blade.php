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
                        <th>No Urut</th>
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
                                <td>{{ $rm->temuDokter->no_urut ?? '-' }}</td>
                                <td>
                                    <strong>{{ $rm->temuDokter->pet->nama ?? '-' }}</strong>
                                    <div class="small text-muted">Owner: {{ $rm->temuDokter->pet->pemilik->user->nama ?? '-' }}</div>
                                    <div class="small text-muted">Contact: {{ $rm->temuDokter->pet->pemilik->no_wa ?? '-' }}</div>
                                </td>
                                <td>{{ optional(\Carbon\Carbon::parse($rm->temuDokter->waktu_daftar ?? $rm->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
                                <td title="{{ $rm->anamnesa ?? '-' }}">{{ Str::limit($rm->anamnesa ?? '-', 5) }}</td>
                                <td title="{{ $rm->temuan_klinis ?? '-' }}">{{ Str::limit($rm->temuan_klinis ?? '-', 5) }}</td>
                                <td title="{{ $rm->diagnosa ?? '-' }}">{{ Str::limit($rm->diagnosa ?? '-', 5) }}</td>
                                <td class="actions align-middle text-center">
                                    <button class="btn btn-sm btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#tindakan-{{ $rm->idrekam_medis }}" aria-expanded="false" aria-controls="tindakan-{{ $rm->idrekam_medis }}">
                                        Lihat Tindakan ({{ $rm->detailRekamMedis->count() }})
                                    </button>
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
                        <tr class="collapse" id="tindakan-{{ $rm->idrekam_medis }}">
                            <td colspan="8">
                                <div class="p-3 bg-light">
                                    <h6>Tindakan untuk Rekam Medis ID: {{ $rm->idrekam_medis }}</h6>
                                    @if($rm->detailRekamMedis->count() > 0)
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Kode Tindakan</th>
                                                    <th>Deskripsi</th>
                                                    <th>Kategori</th>
                                                    <th>Kategori Klinis</th>
                                                    <th>Detail</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rm->detailRekamMedis as $detail)
                                                    <tr>
                                                        <td>{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</td>
                                                        <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>
                                                        <td>{{ $detail->kodeTindakanTerapi->kategori->nama_kategori ?? '-' }}</td>
                                                        <td>{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                                                        <td>{{ $detail->detail }}</td>
                                                        <td class="actions">
                                                            <a href="{{ route('dokter.detailrekammedis.edit', $detail->iddetail_rekam_medis) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('dokter.detailrekammedis.destroy', $detail->iddetail_rekam_medis) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus tindakan ini?')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-muted">Belum ada tindakan untuk rekam medis ini.</p>
                                    @endif
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