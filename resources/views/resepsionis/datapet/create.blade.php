@extends('layouts.lte.main')

@section('content')
    <h1>Tambah Pet</h1>

    <form method="POST" action="{{ route('resepsionis.datapet.store') }}">
        @csrf
        <div>
            <label for="nama">Nama</label>
            <input name="nama" value="{{ old('nama') }}">
        </div>
        <div>
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <input name="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
        </div>
        <div>
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input name="tanggal_lahir" type="date" value="{{ old('tanggal_lahir') }}">
        </div>
        <div>
            <label for="warna_tanda">Warna / Tanda</label>
            <input name="warna_tanda" value="{{ old('warna_tanda') }}">
        </div>
        <div>
            <label for="idpemilik">Pemilik</label>
            <select name="idpemilik">
                @foreach($pemiliks as $pm)
                    <option value="{{ $pm->idpemilik }}">{{ $pm->nama_user ?? $pm->iduser }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="idras_hewan">Ras Hewan</label>
            <select name="idras_hewan">
                @foreach($rasHewans as $r)
                    <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }} ({{ $r->nama_jenis_hewan ?? '' }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('resepsionis.datapet.index') }}">Kembali</a></p>
@endsection
