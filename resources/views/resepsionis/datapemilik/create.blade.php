<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Pemilik</title>
</head>
<body>
    <h1>Tambah Pemilik</h1>

    <form method="POST" action="{{ route('resepsionis.datapemilik.store') }}">
        @csrf
        <div>
            <label for="no_wa">No WA</label>
            <input name="no_wa" value="{{ old('no_wa') }}">
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <input name="alamat" value="{{ old('alamat') }}">
        </div>
        <div>
            <label for="iduser">User (opsional)</label>
            <select name="iduser">
                <option value="">-- pilih --</option>
                @foreach($users as $u)
                    <option value="{{ $u->iduser }}">{{ $u->nama }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>
@extends('layouts.lte.main')

@section('content')
    <h1>Tambah Pemilik</h1>

    <form method="POST" action="{{ route('resepsionis.datapemilik.store') }}">
        @csrf
        <div>
            <label for="nama_pemilik">Nama Pemilik</label>
            <input name="nama_pemilik" value="{{ old('nama_pemilik') }}">
        </div>
        <div>
            <label for="no_wa">No WA</label>
            <input name="no_wa" value="{{ old('no_wa') }}">
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat">{{ old('alamat') }}</textarea>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('resepsionis.datapemilik.index') }}">Kembali</a></p>
@endsection
