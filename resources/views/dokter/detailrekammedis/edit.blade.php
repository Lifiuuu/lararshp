<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Detail Rekam Medis</title>
</head>
@extends('layouts.lte.main')

@section('content')
    <h1>Edit Detail Rekam Medis #{{ $detail->iddetail_rekam_medis }}</h1>

    <form method="POST" action="{{ route('dokter.detailrekammedis.update', $detail->iddetail_rekam_medis) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="idkode_tindakan_terapi">Tindakan</label>
            <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi">
                @foreach($tindakans as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}" @if($detail->idkode_tindakan_terapi == $t->idkode_tindakan_terapi) selected @endif>{{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="detail">Detail</label>
            <textarea name="detail" id="detail">{{ old('detail', $detail->detail) }}</textarea>
        </div>

        <button type="submit">Perbarui</button>
    </form>

    <p><a href="{{ route('dokter.datarekammedis.index') }}">Kembali ke daftar rekam medis</a></p>
@endsection
</html>
