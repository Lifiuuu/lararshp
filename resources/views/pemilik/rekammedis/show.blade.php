@extends('layouts.lte.main')

@section('page-title', 'Detail Rekam Medis')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item"><a href="{{ route('pemilik.rekammedis.index') }}">Rekam Medis</a></li>
  <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Rekam Medis</h3>
                    <div class="card-tools">
                        <a href="{{ route('pemilik.rekammedis.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Pet:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->pet_nama ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Dokter Pemeriksa:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->dokter_nama ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Tanggal Dibuat:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->created_at }}</dd>

                                <dt class="col-sm-4">No Urut:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->no_urut }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Anamnesa:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->anamnesa }}</dd>

                                <dt class="col-sm-4">Temuan Klinis:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->temuan_klinis }}</dd>

                                <dt class="col-sm-4">Diagnosa:</dt>
                                <dd class="col-sm-8">{{ $rekamMedis->diagnosa }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Tindakan Terapi</h3>
                </div>
                <div class="card-body">
                    @if($detailRekamMedis->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Deskripsi Tindakan</th>
                                    <th>Kategori</th>
                                    <th>Kategori Klinis</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailRekamMedis as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->kode }}</td>
                                    <td>{{ $detail->deskripsi_tindakan_terapi }}</td>
                                    <td>{{ $detail->nama_kategori }}</td>
                                    <td>{{ $detail->nama_kategori_klinis }}</td>
                                    <td>{{ $detail->detail }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada detail tindakan terapi untuk rekam medis ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection