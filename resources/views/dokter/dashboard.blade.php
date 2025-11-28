@extends('layouts.lte.main')

@section('page-title', 'Dashboard Dokter')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="row mb-3">
        <div class="col-lg-3 col-6">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $stats['rekam_medis'] ?? 0 }}</h3>
                    <p>Rekam Medis</p>
                </div>
                <div class="icon"><i class="bi bi-file-medical"></i></div>
                <a href="{{ route('dokter.datarekammedis.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Recent Rekam Medis</div>
                <div class="card-body table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pet</th>
                                <th>Waktu Daftar</th>
                                <th>Anamnesa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentRekamMediss as $i => $r)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $r->nama_pet ?? '-' }}</td>
                                    <td>{{ optional(\Carbon\Carbon::parse($r->waktu_daftar ?? $r->created_at ?? null))->format('Y-m-d H:i') ?? '-' }}</td>
                                    <td title="{{ $r->anamnesa ?? '-' }}">{{ Str::limit($r->anamnesa ?? '-', 20) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No recent rekam medis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Quick Links</div>
                <div class="card-body">
                    <a href="{{ route('dokter.datarekammedis.index') }}" class="btn btn-sm btn-primary mb-2">Rekam Medis</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection