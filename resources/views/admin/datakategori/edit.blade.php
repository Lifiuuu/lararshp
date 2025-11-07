@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Data Kategori</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.datakategori.update', $kategori->idkategori) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori"
                                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                                <div class="invalid-feedback">
                                    @error('nama_kategori')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection