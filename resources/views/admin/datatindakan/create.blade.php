@extends('layouts.lte.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Tindakan Terapi</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datatindakan.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="kode">Kode Tindakan</label>
                                <input type="text" 
                                       class="form-control @error('kode') is-invalid @enderror" 
                                       id="kode" 
                                       name="kode"
                                       value="{{ old('kode') }}" 
                                       placeholder="Masukkan kode tindakan"
                                       required>
                            
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="deskripsi_tindakan_terapi">Deskripsi Tindakan</label>
                                <textarea class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                          id="deskripsi_tindakan_terapi" 
                                          name="deskripsi_tindakan_terapi" 
                                          rows="3"
                                          placeholder="Masukkan deskripsi tindakan terapi"
                                          required>{{ old('deskripsi_tindakan_terapi') }}</textarea>
                            
                                @error('deskripsi_tindakan_terapi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="idkategori">Kategori</label>
                                <select class="form-control @error('idkategori') is-invalid @enderror" 
                                        id="idkategori" 
                                        name="idkategori" 
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->idkategori }}" {{ old('idkategori') == $kategori->idkategori ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            
                                @error('idkategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="idkategori_klinis">Kategori Klinis</label>
                                <select class="form-control @error('idkategori_klinis') is-invalid @enderror" 
                                        id="idkategori_klinis" 
                                        name="idkategori_klinis" 
                                        required>
                                    <option value="">Pilih Kategori Klinis</option>
                                    @foreach($kategoriKliniss as $kategoriKlinis)
                                        <option value="{{ $kategoriKlinis->idkategori_klinis }}" {{ old('idkategori_klinis') == $kategoriKlinis->idkategori_klinis ? 'selected' : '' }}>
                                            {{ $kategoriKlinis->nama_kategori_klinis }}
                                        </option>
                                    @endforeach
                                </select>
                            
                                @error('idkategori_klinis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.datatindakan.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
