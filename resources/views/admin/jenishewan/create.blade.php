@extends('layouts.admin.admin')
@section('title', 'Tambah Jenis Hewan')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Jenis Hewan</div>
                    <div class="card-body">
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.jenishewan.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama_jenis_hewan">Nama Jenis Hewan</label>
                                <input type="text" 
                                       class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                                       id="nama_jenis_hewan" 
                                       name="nama_jenis_hewan" 
                                       value="{{ old('nama_jenis_hewan') }}" 
                                       placeholder="Masukkan nama jenis hewan"
                                       required>

                                @error('nama_jenis_hewan')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                <a href="{{ route('admin.jenishewan.index') }}" class="btn btn-secondary mt-3">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
