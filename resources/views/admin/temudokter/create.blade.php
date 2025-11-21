<!-- admin temudokter create -->
@extends('layouts.lte.main')

@section('content')
    <h1>Buat Temu Dokter (Admin)</h1>

    <form method="POST" action="{{ route('admin.temudokter.store') }}">
        @csrf
        <div>
            <label for="no_urut">No Urut</label>
            <input name="no_urut" value="{{ old('no_urut') }}">
        </div>
        <div>
            <label for="waktu_daftar">Waktu Daftar (Y-m-d H:i:s)</label>
            <input name="waktu_daftar" value="{{ old('waktu_daftar') }}">
        </div>
        <div>
            <label for="status">Status</label>
            <input name="status" value="{{ old('status') }}">
        </div>
        <div>
            <label for="idpet">Pet</label>
            <select name="idpet">
                @foreach($pets as $p)
                    <option value="{{ $p->idpet }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="idrole_user">Role User (pemilik)</label>
            <select name="idrole_user">
                @foreach($pemilikRoleUsers as $ru)
                    <option value="{{ $ru->idrole_user }}">{{ $ru->user_nama ?? $ru->iduser }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('admin.temudokter.index') }}">Kembali</a></p>
@endsection
