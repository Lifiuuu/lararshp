<!-- admin temudokter create -->
@extends('layouts.lte.main')

@section('content')
    <h1>Buat Temu Dokter (Admin)</h1>

    <form method="POST" action="{{ route('admin.temudokter.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="idpet" class="form-label">Pilih Pet dan Pemilik</label>
                <select name="idpet" id="idpet" class="form-select" required>
                    <option value="">-- Pilih Pet --</option>
                    @foreach($pets as $pet)
                        <option value="{{ $pet->idpet }}">{{ $pet->nama }} - {{ $pet->pemilik->user->nama ?? '-' }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="idrole_user" class="form-label">Pilih Dokter Pemeriksa</label>
                <select name="idrole_user" id="idrole_user" class="form-select" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->idrole_user }}">{{ $doctor->user->nama ?? '-' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Daftar Temu Dokter</button>
    </form>

    <p><a href="{{ route('admin.temudokter.index') }}">Kembali</a></p>
@endsection
