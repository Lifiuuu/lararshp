@extends('layouts.lte.main')

@section('content')
    <h1>Edit Pemilik #{{ $pemilik->idpemilik }}</h1>

    <form method="POST" action="{{ route('resepsionis.datapemilik.update', $pemilik->idpemilik) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_pemilik">Nama Pemilik</label>
            <input name="nama_pemilik" value="{{ old('nama_pemilik', $pemilik->nama_pemilik ?? '') }}">
        </div>
        <div>
            <label for="no_wa">No WA</label>
            <input name="no_wa" value="{{ old('no_wa', $pemilik->no_wa) }}">
        </div>
        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat">{{ old('alamat', $pemilik->alamat ?? '') }}</textarea>
        </div>
        <div>
            <label for="iduser">User (opsional)</label>
            <select name="iduser">
                <option value="">-- pilih --</option>
                @foreach($users as $u)
                    <option value="{{ $u->iduser }}" @if(($pemilik->iduser ?? null) == $u->iduser) selected @endif>{{ $u->nama }} ({{ $u->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Perbarui</button>
    </form>

    <p><a href="{{ route('resepsionis.datapemilik.index') }}">Kembali</a></p>
@endsection
