@extends('layouts.lte.main')

@section('page-title', 'Data Rekam Medis')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Rekam Medis</li>
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
                                <th>No Urut</th>
                                <th>Nama Pet</th>
                                <th>Waktu Daftar</th>
                                <th>Anamnesa</th>
                                <th>Temuan Klinis</th>
                                <th>Diagnosa</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rekamMediss as $i => $rekam)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $rekam->temuDokter->pet->nama ?? '-' }}</td>
                                    <td>{{ optional(\Carbon\Carbon::parse($rekam->temuDokter->waktu_daftar))->format('Y-m-d H:i') ?? '-' }}</td>
                                    <td title="{{ $rekam->anamnesa }}">{{ Str::limit($rekam->anamnesa, 30) }}</td>
                                    <td title="{{ $rekam->temuan_klinis }}">{{ Str::limit($rekam->temuan_klinis, 30) }}</td>
                                    <td title="{{ $rekam->diagnosa }}">{{ Str::limit($rekam->diagnosa, 30) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#tindakan-{{ $rekam->idrekam_medis }}" aria-expanded="false" aria-controls="tindakan-{{ $rekam->idrekam_medis }}">
                                            Lihat Tindakan ({{ $rekam->detailRekamMedis->count() }})
                                        </button>
                                        <a href="{{ route('admin.detailrekammedis.create', $rekam->idrekam_medis) }}" class="btn btn-sm btn-success">Tambah Tindakan</a>
                                    </td>
                                </tr>
                                <tr class="collapse" id="tindakan-{{ $rekam->idrekam_medis }}">
                                    <td colspan="8">
                                        <div class="p-3 bg-light">
                                            <h6>Tindakan untuk Rekam Medis ID: {{ $rekam->idrekam_medis }}</h6>
                                            @if($rekam->detailRekamMedis->count() > 0)
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
                                                        @foreach($rekam->detailRekamMedis as $detail)
                                                            <tr>
                                                                <td>{{ $detail->kodeTindakanTerapi->kode ?? '-' }}</td>
                                                                <td>{{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}</td>
                                                                <td>{{ $detail->kodeTindakanTerapi->kategori->nama_kategori ?? '-' }}</td>
                                                                <td>{{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                                                                <td>{{ $detail->detail }}</td>
                                                                <td class="actions">
                                                                    <a href="{{ route('admin.detailrekammedis.edit', $detail->iddetail_rekam_medis) }}" class="btn btn-sm btn-warning">Edit</a>
                                                                    <form action="{{ route('admin.detailrekammedis.destroy', $detail->iddetail_rekam_medis) }}" method="POST" class="d-inline">
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
                                    <td colspan="8" class="text-center">No rekam medis found.</td>
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
