@extends('layouts.lte.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Tambah Pemilik</div>
        <div class="card-body">
            <form method="POST" action="{{ route('resepsionis.datapemilik.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="no_wa">No WA</label>
                    <input id="no_wa" name="no_wa" class="form-control" value="{{ old('no_wa') }}">
                    @error('no_wa')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="iduser">User (opsional)</label>
                    <select id="iduser" name="iduser" class="form-select">
                        <option value="">-- pilih --</option>
                        @foreach($users as $u)
                            <option value="{{ $u->iduser }}">{{ $u->nama }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                    @error('iduser')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('resepsionis.datapemilik.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
