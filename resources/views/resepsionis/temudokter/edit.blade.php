@extends('layouts.lte.main')

@section('content')
    <h1>Edit Temu Dokter #{{ $temu->idreservasi_dokter }}</h1>

    <form method="POST" action="{{ route('resepsionis.temudokter.update', $temu->idreservasi_dokter) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="no_urut">No Urut</label>
            <input name="no_urut" value="{{ old('no_urut', $temu->no_urut) }}">
        </div>
        <div>
            <label for="waktu_daftar">Waktu Daftar</label>
            <input name="waktu_daftar" value="{{ old('waktu_daftar', $temu->waktu_daftar) }}">
        </div>
        <div>
            <label for="status">Status</label>
            <input name="status" value="{{ old('status', $temu->status) }}">
        </div>
        <div>
            <label for="idpet">Pet</label>
            <select name="idpet">
                @foreach($pets as $p)
                    <option value="{{ $p->idpet }}" @if($temu->idpet == $p->idpet) selected @endif>{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="idrole_user">Role User (pemilik)</label>
            <select name="idrole_user">
                @foreach($pemilikRoleUsers as $ru)
                    <option value="{{ $ru->idrole_user }}" @if($temu->idrole_user == $ru->idrole_user) selected @endif>{{ $ru->user_nama ?? $ru->iduser }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Perbarui</button>
    </form>

    <p><a href="{{ route('resepsionis.temudokter.index') }}">Kembali</a></p>
@endsection
