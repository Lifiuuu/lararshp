@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Rekam Medis</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datarekammedis.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="idreservasi_dokter">Reservasi Dokter</label>
                                <select class="form-control @error('idreservasi_dokter') is-invalid @enderror" 
                                        id="idreservasi_dokter" 
                                        name="idreservasi_dokter" 
                                        required>
                                    <option value="">Pilih Reservasi</option>
                                    @foreach($temuDokters as $temu)
                                        <option value="{{ $temu->idreservasi_dokter }}" {{ old('idreservasi_dokter') == $temu->idreservasi_dokter ? 'selected' : '' }}>
                                            {{ $temu->no_urut }} - {{ $temu->pet->nama }} ({{ $temu->waktu_daftar }})
                                        </option>
                                    @endforeach
                                </select>
                            
                                @error('idreservasi_dokter')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="dokter_pemeriksa">Dokter Pemeriksa</label>
                                <select class="form-control @error('dokter_pemeriksa') is-invalid @enderror" 
                                        id="dokter_pemeriksa" 
                                        name="dokter_pemeriksa" 
                                        required>
                                    <option value="">Pilih Dokter</option>
                                    @foreach($dokters as $dokter)
                                        <option value="{{ $dokter->idrole_user }}" {{ old('dokter_pemeriksa') == $dokter->idrole_user ? 'selected' : '' }}>
                                            {{ $dokter->user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            
                                @error('dokter_pemeriksa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="anamnesa">Anamnesa</label>
                                <textarea class="form-control @error('anamnesa') is-invalid @enderror" 
                                          id="anamnesa" 
                                          name="anamnesa" 
                                          rows="3"
                                          placeholder="Masukkan anamnesa/keluhan"
                                          required>{{ old('anamnesa') }}</textarea>
                            
                                @error('anamnesa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="temuan_klinis">Temuan Klinis</label>
                                <textarea class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                          id="temuan_klinis" 
                                          name="temuan_klinis" 
                                          rows="3"
                                          placeholder="Masukkan temuan klinis"
                                          required>{{ old('temuan_klinis') }}</textarea>
                            
                                @error('temuan_klinis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="diagnosa">Diagnosa</label>
                                <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                                          id="diagnosa" 
                                          name="diagnosa" 
                                          rows="3"
                                          placeholder="Masukkan diagnosa"
                                          required>{{ old('diagnosa') }}</textarea>
                            
                                @error('diagnosa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.datarekammedis.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
