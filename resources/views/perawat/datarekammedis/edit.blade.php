@extends('layouts.lte.main')

@section('page-title', 'Edit Rekam Medis')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('perawat.datarekammedis.index') }}">Data Rekam Medis</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Edit Rekam Medis #{{ $rekam->idrekam_medis }}</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('perawat.datarekammedis.update', $rekam->idrekam_medis) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="dokter_pemeriksa" class="form-label">Dokter Pemeriksa</label>
                    <input type="text" class="form-control" value="{{ $dokter->nama ?? ($rekam->roleUser->user->nama ?? '-') }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="anamnesa" class="form-label">Anamnesa</label>
                    <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3" required>{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                    <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="3" required>{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Perbarui</button>
                <a href="{{ route('perawat.datarekammedis.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
