@extends('layouts.lte.main')

@section('page-title', 'Tambah Detail Rekam Medis')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.datatindakan.index') }}">Data Rekam Medis</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.detailrekammedis.index') }}">Detail Rekam Medis</a></li>
<li class="breadcrumb-item active">Tambah Detail Rekam Medis</li>
@endsection

@section('content')
<div class="container-fluid p-3">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Detail Rekam Medis untuk Rekam Medis ID: {{ $rekam->idrekam_medis }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Anamnesa</label>
                        <textarea class="form-control" readonly>{{ $rekam->anamnesa ?? '-' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis</label>
                        <textarea class="form-control" readonly>{{ $rekam->temuan_klinis ?? '-' }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Diagnosa</label>
                        <textarea class="form-control" readonly>{{ $rekam->diagnosa ?? '-' }}</textarea>
                    </div>
                    <form action="{{ route('admin.detailrekammedis.store') }}" method="POST" id="tindakanForm">
                        @csrf
                        <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis }}">
                        <div id="tindakanRows">
                            <div class="row mb-3 tindakan-row">
                                <div class="col-md-5">
                                    <label class="form-label">Kode Tindakan Terapi</label>
                                    <select name="idkode_tindakan_terapi[]" class="form-control" required>
                                        <option value="">Pilih Tindakan</option>
                                        @foreach($tindakans as $t)
                                            <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Detail</label>
                                    <textarea name="detail[]" class="form-control" rows="2"></textarea>
                                </div>
                                <div class="col-auto d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-row" style="display:none; padding:.35rem .5rem; font-size:.85rem; min-width:56px;">Hapus</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary mb-3" id="addRow">Tambah Tindakan Lain</button>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan Semua</button>
                        <a href="{{ route('admin.datatindakan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('addRow').addEventListener('click', function() {
    const container = document.getElementById('tindakanRows');
    const rows = container.querySelectorAll('.tindakan-row');
    const newRow = rows[0].cloneNode(true);

    // Reset values
    newRow.querySelector('select').selectedIndex = 0;
    newRow.querySelector('textarea').value = '';

    // Show remove button
    newRow.querySelector('.remove-row').style.display = 'block';

    container.appendChild(newRow);
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('.tindakan-row').remove();
    }
});
</script>
@endpush
