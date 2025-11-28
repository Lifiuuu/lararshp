@extends('layouts.lte.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Profile Pemilik</div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('pemilik.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   id="nama"
                                   name="nama"
                                   value="{{ old('nama', $user->nama) }}"
                                   placeholder="Masukkan nama"
                                   required>

                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="Masukkan email"
                                   required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_wa">No WA</label>
                            <input type="text"
                                   class="form-control @error('no_wa') is-invalid @enderror"
                                   id="no_wa"
                                   name="no_wa"
                                   value="{{ old('no_wa', $pemilik->no_wa) }}"
                                   placeholder="Masukkan nomor WA"
                                   required>

                            @error('no_wa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text"
                                   class="form-control @error('alamat') is-invalid @enderror"
                                   id="alamat"
                                   name="alamat"
                                   value="{{ old('alamat', $pemilik->alamat) }}"
                                   placeholder="Masukkan alamat"
                                   required>

                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('pemilik.dashboard') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection