@extends('layouts.lte.main')

@section('page-title', 'Edit Detail Rekam Medis')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.datatindakan.index') }}">Data Rekam Medis</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.detailrekammedis.index') }}">Detail Rekam Medis</a></li>
<li class="breadcrumb-item active">Edit Detail Rekam Medis</li>
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Detail Rekam Medis ID: {{ $detail->iddetail_rekam_medis }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.detailrekammedis.update', $detail->iddetail_rekam_medis) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Kode Tindakan Terapi</label>
                            <input type="text" class="form-control" value="{{ $detail->kodeTindakanTerapi->kode ?? '-' }} - {{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}" readonly>
                            <input type="hidden" name="idkode_tindakan_terapi" value="{{ $detail->idkode_tindakan_terapi }}">
                        </div>
                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea name="detail" id="detail" class="form-control" rows="4">{{ $detail->detail }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.datatindakan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
