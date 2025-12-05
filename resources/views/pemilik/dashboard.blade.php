@extends('layouts.lte.main')

@section('page-title', 'Dashboard Pemilik')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
  <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="container-fluid p-3">
        <div class="row mb-3">
            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary">
                    <div class="inner">
                        <h5>Jumlah Pet</h5>
                        <p>{{ count($data['pets']) }}</p>
                    </div>
                    <div class="icon"><i class="bi bi-heart"></i></div>
                    <a href="{{ route('pemilik.pet.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                    <div class="inner">
                        <h5>Jumlah Rekam Medis</h5>
                        <p>{{ count($data['rekamMediss']) }}</p>
                    </div>
					<div class="icon"><i class="bi bi-file-medical"></i></div>
                    <a href="{{ route('pemilik.rekammedis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>


    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Pet Terbaru</div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($data['pets']->take(5) as $pet)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $pet->nama }}
                            <span class="badge badge-secondary">{{ $pet->rasHewan->nama_ras ?? '-' }}</span>
                        </li>
                        @empty
                        <li class="list-group-item">Belum ada data pet.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('pemilik.pet.index') }}" class="btn btn-link">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Rekam Medis Terbaru</div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($data['rekamMediss']->take(5) as $rekamMedis)
                        <li class="list-group-item">
                            <div><strong>{{ optional($rekamMedis->temuDokter->pet)->nama ?? '-' }}</strong></div>
                            <div class="small text-muted">{{ optional(\Carbon\Carbon::parse($rekamMedis->temuDokter->waktu_daftar ?? $rekamMedis->created_at))->format('Y-m-d H:i') ?? '-' }}</div>
                            <div class="small">Diagnosa: {{ $rekamMedis->diagnosa ?? '-' }}</div>
                        </li>
                        @empty
                        <li class="list-group-item">Belum ada data rekam medis.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('pemilik.rekammedis.index') }}" class="btn btn-link">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
