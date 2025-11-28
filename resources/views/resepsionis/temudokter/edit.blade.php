@extends('layouts.lte.main')

@section('page-title', 'Edit Status Temu Dokter')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('resepsionis.temudokter.index') }}">Temu Dokter</a></li>
<li class="breadcrumb-item active">Edit Status</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Status Temu Dokter</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('resepsionis.temudokter.update', $temu->idreservasi_dokter) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="P" {{ $temu->status == 'P' ? 'selected' : '' }}>Pending</option>
                                <option value="D" {{ $temu->status == 'D' ? 'selected' : '' }}>Selesai</option>
                                <option value="C" {{ $temu->status == 'C' ? 'selected' : '' }}>Batal</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('resepsionis.temudokter.index') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection