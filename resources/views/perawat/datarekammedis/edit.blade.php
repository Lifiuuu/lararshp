@extends('layouts.lte.main')

@section('content')
    <h1>Edit Rekam Medis #{{ $rekam->idrekam_medis }}</h1>

    <form method="POST" action="{{ route('perawat.datarekammedis.update', $rekam->idrekam_medis) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="dokter_pemeriksa">Dokter</label>
            <select name="dokter_pemeriksa">
                @foreach($dokters as $d)
                    <option value="{{ $d->idrole_user }}" @if($rekam->dokter_pemeriksa == $d->idrole_user) selected @endif>{{ $d->nama_user }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="anamnesa">Anamnesa</label>
            <textarea name="anamnesa">{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
        </div>

        <div>
            <label for="temuan_klinis">Temuan Klinis</label>
            <textarea name="temuan_klinis">{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
        </div>

        <div>
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa">{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
        </div>

        <button type="submit">Perbarui</button>
    </form>

    <p><a href="{{ route('perawat.datarekammedis.index') }}">Kembali ke daftar</a></p>
@endsection
