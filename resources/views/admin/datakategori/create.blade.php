@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Kategori</div>
                    <div class="card-body">
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datakategori.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama">Nama Kategori</label>
                                <input type="text" 
                                       class="form-control @error('nama_kategori') is-invalid @enderror" 
                                       id="nama" 
                                       name="nama_kategori"
                                       value="{{ old('nama_kategori') }}" 
                                       placeholder="Masukkan nama kategori"
                                       required>
                            
                                    @error('nama_kategori')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.datakategori.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection