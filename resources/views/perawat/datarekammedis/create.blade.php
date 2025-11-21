@extends('layouts.lte.main')

@section('content')
    <h1>Tambah Rekam Medis</h1>

    <form method="POST" action="{{ route('perawat.datarekammedis.store') }}">
        @csrf

        <div>
            <label for="idreservasi_dokter">Reservasi Dokter</label>
            <select name="idreservasi_dokter">
                @foreach($temuDokters as $t)
                    <option value="{{ $t->idreservasi_dokter }}">#{{ $t->idreservasi_dokter }} - {{ $t->nama_pet }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="dokter_pemeriksa">Dokter</label>
            <select name="dokter_pemeriksa">
                @foreach($dokters as $d)
                    <option value="{{ $d->idrole_user }}">{{ $d->nama_user }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="anamnesa">Anamnesa</label>
            <textarea name="anamnesa">{{ old('anamnesa') }}</textarea>
        </div>

        <div>
            <label for="temuan_klinis">Temuan Klinis</label>
            <textarea name="temuan_klinis">{{ old('temuan_klinis') }}</textarea>
        </div>

        <div>
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa">{{ old('diagnosa') }}</textarea>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('perawat.datarekammedis.index') }}">Kembali ke daftar</a></p>
@endsection
