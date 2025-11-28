@extends('layouts.lte.main')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Tambah Pet</div>
            <div class="card-body">
                <form method="POST" action="{{ route('resepsionis.datapet.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="nama">Nama</label>
                        <input id="nama" name="nama" class="form-control" value="{{ old('nama') }}">
                        @error('nama')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                            <option value="Jantan" @if(old('jenis_kelamin')=='Jantan') selected @endif>Jantan</option>
                            <option value="Betina" @if(old('jenis_kelamin')=='Betina') selected @endif>Betina</option>
                        </select>
                        @error('jenis_kelamin')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="warna_tanda">Warna / Tanda</label>
                        <input id="warna_tanda" name="warna_tanda" class="form-control" value="{{ old('warna_tanda') }}">
                        @error('warna_tanda')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="idpemilik">Pemilik</label>
                        <select id="idpemilik" name="idpemilik" class="form-select">
                            @foreach($pemiliks as $pm)
                                <option value="{{ $pm->idpemilik }}">{{ $pm->nama_user ?? $pm->iduser }}</option>
                            @endforeach
                        </select>
                        @error('idpemilik')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="idras_hewan">Ras Hewan</label>
                        <select id="idras_hewan" name="idras_hewan" class="form-select">
                            @foreach($rasHewans as $r)
                                <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }} ({{ $r->nama_jenis_hewan ?? '' }})</option>
                            @endforeach
                        </select>
                        @error('idras_hewan')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('resepsionis.datapet.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
