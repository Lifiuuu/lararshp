@extends('layouts.lte.main')

@section('page-title', 'Tambah Rekam Medis')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.datarekammedis.index') }}">Data Rekam Medis</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Tambah Rekam Medis</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.datarekammedis.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="idreservasi_dokter" class="form-label">Pilih Temu Dokter</label>
                    <select name="idreservasi_dokter" id="idreservasi_dokter" class="form-select" required>
                        <option value="">-- Pilih Temu Dokter --</option>
                        @foreach($temuDokters as $t)
                            <option value="{{ $t->idreservasi_dokter }}">
                                {{ $t->no_urut ?? $t->idreservasi_dokter }} - {{ $t->nama_pet }} - {{ $t->nama_pemilik }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="anamnesa" class="form-label">Anamnesa</label>
                    <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3" required>{{ old('anamnesa') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                    <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="3" required>{{ old('temuan_klinis') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.datarekammedis.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
