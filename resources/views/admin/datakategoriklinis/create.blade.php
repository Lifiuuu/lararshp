@extends('layouts.lte.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Kategori</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datakategoriklinis.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama_kategori_klinis">Nama Kategori Klinis</label>
                                <input type="text" 
                                       class="form-control @error('nama_kategori_klinis') is-invalid @enderror" 
                                       id="nama_kategori_klinis" 
                                       name="nama_kategori_klinis"
                                       value="{{ old('nama_kategori_klinis') }}" 
                                       placeholder="Masukkan nama kategori klinis"
                                       required>
                            
                                @error('nama_kategori_klinis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.datakategoriklinis.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection