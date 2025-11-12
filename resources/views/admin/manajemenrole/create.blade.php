@extends('layouts.admin.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Role</div>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.manajemenrole.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="nama_role">Nama Role</label>
                                <input type="text" 
                                       class="form-control @error('nama_role') is-invalid @enderror" 
                                       id="nama_role" 
                                       name="nama_role"
                                       value="{{ old('nama_role') }}" 
                                       placeholder="Masukkan nama role"
                                       required>
                            
                                @error('nama_role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.manajemenrole.index') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
