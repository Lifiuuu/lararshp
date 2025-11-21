@extends('layouts.lte.main')

@section('content')
    <h1>Tambah Detail Rekam Medis untuk Rekam #{{ $rekam->idrekam_medis ?? '' }}</h1>

    <form method="POST" action="{{ route('dokter.detailrekammedis.store') }}">
        @csrf
        <input type="hidden" name="idrekam_medis" value="{{ $rekam->idrekam_medis ?? old('idrekam_medis') }}">

        <div>
            <label for="idkode_tindakan_terapi">Tindakan</label>
            <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi">
                @foreach($tindakans as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="detail">Detail</label>
            <textarea name="detail" id="detail">{{ old('detail') }}</textarea>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('dokter.datarekammedis.index') }}">Kembali ke daftar rekam medis</a></p>
@endsection
